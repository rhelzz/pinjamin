<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $alatIds = array_keys($cart);
        $bukus = Buku::with('genre')->whereIn('id', $alatIds)->get();

        return view('peminjam.cart.index', compact('cart', 'bukus'));
    }

    public function add(Request $request, Buku $buku)
    {
        $request->validate([
            'jumlah' => 'nullable|integer|min:1|max:' . $buku->stok,
        ]);

        $jumlah = (int)$request->input('jumlah', 1);
        $cart = session('cart', []);

        if (isset($cart[$buku->id])) {
            $cart[$buku->id]['jumlah'] = (int)$cart[$buku->id]['jumlah'] + $jumlah;
            if ($cart[$buku->id]['jumlah'] > $buku->stok) {
                $cart[$buku->id]['jumlah'] = (int)$buku->stok;
            }
        } else {
            $cart[$buku->id] = [
                'jumlah' => (int)min($jumlah, $buku->stok),
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', "{$buku->judul} ditambahkan ke keranjang.");
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $buku->stok,
        ]);

        $cart = session('cart', []);

        if (isset($cart[$buku->id])) {
            $cart[$buku->id]['jumlah'] = (int)$request->jumlah;
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Jumlah diperbarui.');
    }

    public function remove(Buku $buku)
    {
        $cart = session('cart', []);
        unset($cart[$buku->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('peminjam.katalog.index')
            ->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date|after_or_equal:today',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {
            // Verify stock availability (race condition prevention)
            foreach ($cart as $alatId => $item) {
                $jumlah = is_array($item) ? (int)($item['jumlah'] ?? 1) : (int)$item;
                $buku = Buku::lockForUpdate()->find($alatId);
                
                if (!$buku || $buku->stok < $jumlah) {
                    DB::rollBack();
                    $namaBuku = $buku ? $buku->judul : 'buku';
                    return back()->with('error', "Stok {$namaBuku} tidak mencukupi.");
                }
            }

            // Create peminjaman
            $peminjaman = Peminjaman::create([
                'user_id' => Auth::id(),
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => 'Pending',
            ]);

            // Create details (stock is reduced when approved by petugas)
            foreach ($cart as $alatId => $item) {
                // Ensure jumlah is properly extracted
                $jumlah = is_array($item) ? (int)($item['jumlah'] ?? 1) : (int)$item;
                
                PeminjamanDetail::create([
                    'peminjaman_id' => $peminjaman->id,
                    'buku_id' => (int)$alatId,
                    'jumlah' => $jumlah,
                ]);
            }

            // Notify all petugas & admin
            $petugasUsers = User::whereHas('role', function($q) {
                $q->whereIn('nama_role', ['Admin', 'Petugas']);
            })->get();
            foreach ($petugasUsers as $petugas) {
                Notifikasi::create([
                    'user_id' => $petugas->id,
                    'pesan' => 'Peminjaman baru #' . $peminjaman->id . ' dari ' . Auth::user()->name . ' menunggu persetujuan.',
                ]);
            }

            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aktivitas' => "Mengajukan peminjaman #{$peminjaman->id}",
            ]);

            DB::commit();

            session()->forget('cart');

            return redirect()->route('peminjam.peminjaman.index')
                ->with('success', 'Peminjaman berhasil diajukan. Menunggu persetujuan petugas.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
