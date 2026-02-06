<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
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
        $alats = Alat::with('kategori')->whereIn('id', $alatIds)->get();

        return view('peminjam.cart.index', compact('cart', 'alats'));
    }

    public function add(Request $request, Alat $alat)
    {
        $request->validate([
            'jumlah' => 'nullable|integer|min:1|max:' . $alat->stok,
        ]);

        $jumlah = $request->input('jumlah', 1);
        $cart = session('cart', []);

        if (isset($cart[$alat->id])) {
            $cart[$alat->id]['jumlah'] += $jumlah;
            if ($cart[$alat->id]['jumlah'] > $alat->stok) {
                $cart[$alat->id]['jumlah'] = $alat->stok;
            }
        } else {
            $cart[$alat->id] = [
                'jumlah' => min($jumlah, $alat->stok),
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', "{$alat->nama_alat} ditambahkan ke keranjang.");
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $alat->stok,
        ]);

        $cart = session('cart', []);

        if (isset($cart[$alat->id])) {
            $cart[$alat->id]['jumlah'] = $request->jumlah;
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Jumlah diperbarui.');
    }

    public function remove(Alat $alat)
    {
        $cart = session('cart', []);
        unset($cart[$alat->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item dihapus dari keranjang.');
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
                $alat = Alat::lockForUpdate()->find($alatId);
                if (!$alat || $alat->stok < $item['jumlah']) {
                    DB::rollBack();
                    return back()->with('error', "Stok {$alat?->nama_alat ?? 'alat'} tidak mencukupi.");
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
                PeminjamanDetail::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id' => $alatId,
                    'jumlah' => $item['jumlah'],
                ]);
            }

            // Notify all petugas & admin
            $petugasUsers = User::whereIn('role_id', [1, 2])->get();
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
