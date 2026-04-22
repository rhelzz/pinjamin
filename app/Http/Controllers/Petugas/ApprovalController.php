<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $allowedSorts = ['id', 'created_at', 'tanggal_kembali'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }
        
        $peminjamans = Peminjaman::with(['user', 'detail.buku'])
            ->where('status', 'Pending')
            ->orderBy($sortBy, $sortDirection)
            ->paginate(10)
            ->withQueryString();

        return view('petugas.approval.index', compact('peminjamans'));
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'detail.buku.genre']);
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
                $buku = Buku::lockForUpdate()->find($detail->buku_id);
                $jumlah = (int)$detail->jumlah;
                
                if ($buku->stok < $jumlah) {
                    DB::rollBack();
                    return back()->with('error', "Stok {$buku->judul} tidak mencukupi ({$buku->stok} tersisa, {$jumlah} dibutuhkan).");
                }
                
                $buku->stok -= $jumlah;
                $buku->save();
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
                'pesan' => "Peminjaman #{$peminjaman->id} telah DISETUJUI. Silakan ambil buku Anda.",
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
