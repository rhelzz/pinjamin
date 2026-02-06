<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'detail.alat'])
            ->where('status', 'Dipinjam')
            ->latest()
            ->paginate(10);

        return view('petugas.pengembalian.index', compact('peminjamans'));
    }

    public function create(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'Dipinjam') {
            return back()->with('error', 'Peminjaman ini tidak dalam status Dipinjam.');
        }

        $peminjaman->load(['user', 'detail.alat']);

        return view('petugas.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'Dipinjam') {
            return back()->with('error', 'Peminjaman ini tidak dalam status Dipinjam.');
        }

        $request->validate([
            'kondisi' => 'required|in:Baik,Rusak',
            'denda' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();

        try {
            // Create pengembalian record
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_dikembalikan' => now()->toDateString(),
                'denda' => $request->denda ?? 0,
                'kondisi' => $request->kondisi,
                'catatan' => $request->catatan,
            ]);

            // Update peminjaman status
            $peminjaman->update(['status' => 'Selesai']);

            // Return stock
            foreach ($peminjaman->detail as $detail) {
                $alat = Alat::lockForUpdate()->find($detail->alat_id);
                if ($alat) {
                    $alat->stok += $detail->jumlah;
                    $alat->save();

                    // Log damaged items
                    if ($request->kondisi === 'Rusak') {
                        LogAktivitas::create([
                            'user_id' => Auth::id(),
                            'aktivitas' => "Alat {$alat->nama_alat} dikembalikan dalam kondisi RUSAK (Peminjaman #{$peminjaman->id})",
                        ]);
                    }
                }
            }

            // Notify borrower
            $dendaText = $request->denda > 0 ? ' Denda: Rp ' . number_format($request->denda, 0, ',', '.') : '';
            Notifikasi::create([
                'user_id' => $peminjaman->user_id,
                'pesan' => "Pengembalian untuk peminjaman #{$peminjaman->id} telah diproses. Kondisi: {$request->kondisi}.{$dendaText}",
            ]);

            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aktivitas' => "Memproses pengembalian peminjaman #{$peminjaman->id} dari {$peminjaman->user->name} (Kondisi: {$request->kondisi})",
            ]);

            DB::commit();

            return redirect()->route('petugas.pengembalian.index')
                ->with('success', 'Pengembalian berhasil diproses.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
