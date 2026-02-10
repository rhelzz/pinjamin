<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'detail.alat', 'pengembalian']);

        if ($request->filled('dari_tanggal')) {
            $query->whereDate('created_at', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('created_at', '<=', $request->sampai_tanggal);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $allowedSorts = ['id', 'created_at', 'tanggal_pinjam', 'tanggal_kembali', 'status'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }
        
        $peminjamans = $query->orderBy($sortBy, $sortDirection)->paginate(15)->withQueryString();

        // Calculate stats for display
        $statsQuery = Peminjaman::query();
        if ($request->filled('dari_tanggal')) {
            $statsQuery->whereDate('created_at', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $statsQuery->whereDate('created_at', '<=', $request->sampai_tanggal);
        }
        
        $stats = [
            'total' => $statsQuery->clone()->count(),
            'pending' => $statsQuery->clone()->where('status', 'pending')->count(),
            'dipinjam' => $statsQuery->clone()->where('status', 'dipinjam')->count(),
            'selesai' => $statsQuery->clone()->where('status', 'selesai')->count(),
            'ditolak' => $statsQuery->clone()->where('status', 'ditolak')->count(),
        ];

        // Calculate total denda
        $dendaQuery = Pengembalian::query();
        if ($request->filled('dari_tanggal')) {
            $dendaQuery->whereHas('peminjaman', function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->dari_tanggal);
            });
        }
        if ($request->filled('sampai_tanggal')) {
            $dendaQuery->whereHas('peminjaman', function ($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->sampai_tanggal);
            });
        }
        $totalDenda = $dendaQuery->sum('denda');

        return view('petugas.laporan.index', compact('peminjamans', 'stats', 'totalDenda'));
    }

    public function cetak(Request $request)
    {
        $query = Peminjaman::with(['user', 'detail.alat', 'pengembalian']);

        if ($request->filled('dari_tanggal')) {
            $query->whereDate('created_at', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('created_at', '<=', $request->sampai_tanggal);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjamans = $query->latest()->get();

        // Calculate total denda for the period
        $totalDenda = 0;
        foreach ($peminjamans as $peminjaman) {
            if ($peminjaman->pengembalian && $peminjaman->pengembalian->denda > 0) {
                $totalDenda += $peminjaman->pengembalian->denda;
            }
        }

        // Stats
        $stats = [
            'total' => $peminjamans->count(),
            'pending' => $peminjamans->where('status', 'pending')->count(),
            'dipinjam' => $peminjamans->where('status', 'dipinjam')->count(),
            'selesai' => $peminjamans->where('status', 'selesai')->count(),
            'ditolak' => $peminjamans->where('status', 'ditolak')->count(),
        ];

        $pdf = Pdf::loadView('petugas.laporan.cetak', [
            'peminjamans' => $peminjamans,
            'dari_tanggal' => $request->dari_tanggal,
            'sampai_tanggal' => $request->sampai_tanggal,
            'status' => $request->status,
            'totalDenda' => $totalDenda,
            'stats' => $stats,
        ]);

        // Set paper to A4
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('laporan-peminjaman-' . now()->format('Y-m-d') . '.pdf');
    }
}
