<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'detail.alat'])
            ->where('status', 'Pending')
            ->latest()
            ->paginate(10);

        return view('petugas.approval.index', compact('peminjamans'));
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'detail.alat.kategori']);
        return view('petugas.approval.show', compact('peminjaman'));
    }

    public function approve(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'Pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        DB::beginTransaction();

        try {
            // Check and reduce stock
            foreach ($peminjaman->detail as $detail) {
                $alat = Alat::lockForUpdate()->find($detail->alat_id);
                $jumlah = (int)$detail->jumlah;
                
                if ($alat->stok < $jumlah) {
                    DB::rollBack();
                    return back()->with('error', "Stok {$alat->nama_alat} tidak mencukupi ({$alat->stok} tersisa, {$jumlah} dibutuhkan).");
                }
                
                $alat->stok -= $jumlah;
                $alat->save();
            }

            $peminjaman->update([
                'status' => 'Dipinjam',
                'tanggal_pinjam' => now()->toDateString(),
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);

            // Notify borrower
            Notifikasi::create([
                'user_id' => $peminjaman->user_id,
                'pesan' => "Peminjaman #{$peminjaman->id} telah DISETUJUI. Silakan ambil alat Anda.",
            ]);

            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aktivitas' => "Menyetujui peminjaman #{$peminjaman->id} dari {$peminjaman->user->name}",
            ]);

            DB::commit();

            return redirect()->route('petugas.approval.index')
                ->with('success', 'Peminjaman berhasil disetujui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'Pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        $request->validate([
            'alasan_tolak' => 'required|string|max:500',
        ]);

        $peminjaman->update([
            'status' => 'Ditolak',
            'alasan_tolak' => $request->alasan_tolak,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        Notifikasi::create([
            'user_id' => $peminjaman->user_id,
            'pesan' => "Peminjaman #{$peminjaman->id} telah DITOLAK. Alasan: {$request->alasan_tolak}",
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menolak peminjaman #{$peminjaman->id} dari {$peminjaman->user->name}",
        ]);

        return redirect()->route('petugas.approval.index')
            ->with('success', 'Peminjaman telah ditolak.');
    }
}
