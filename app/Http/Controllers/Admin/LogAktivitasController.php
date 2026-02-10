<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $query = LogAktivitas::with('user');

        // Search
        if ($request->filled('search')) {
            $query->where('aktivitas', 'like', "%{$request->search}%");
        }

        // Filter by action type
        if ($request->filled('aksi')) {
            $aksi = $request->aksi;
            switch ($aksi) {
                case 'auth':
                    $query->where(function($q) {
                        $q->where('aktivitas', 'like', '%login%')
                          ->orWhere('aktivitas', 'like', '%logout%')
                          ->orWhere('aktivitas', 'like', '%register%');
                    });
                    break;
                case 'crud':
                    $query->where(function($q) {
                        $q->where('aktivitas', 'like', '%menambah%')
                          ->orWhere('aktivitas', 'like', '%mengubah%')
                          ->orWhere('aktivitas', 'like', '%menghapus%')
                          ->orWhere('aktivitas', 'like', '%membuat%')
                          ->orWhere('aktivitas', 'like', '%edit%')
                          ->orWhere('aktivitas', 'like', '%hapus%')
                          ->orWhere('aktivitas', 'like', '%tambah%');
                    });
                    break;
                case 'peminjaman':
                    $query->where(function($q) {
                        $q->where('aktivitas', 'like', '%peminjaman%')
                          ->orWhere('aktivitas', 'like', '%pinjam%')
                          ->orWhere('aktivitas', 'like', '%checkout%')
                          ->orWhere('aktivitas', 'like', '%approve%')
                          ->orWhere('aktivitas', 'like', '%reject%')
                          ->orWhere('aktivitas', 'like', '%tolak%')
                          ->orWhere('aktivitas', 'like', '%setuju%');
                    });
                    break;
                case 'pengembalian':
                    $query->where(function($q) {
                        $q->where('aktivitas', 'like', '%pengembalian%')
                          ->orWhere('aktivitas', 'like', '%kembali%')
                          ->orWhere('aktivitas', 'like', '%return%');
                    });
                    break;
            }
        }

        // Filter by date range
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('timestamp', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('timestamp', '<=', $request->sampai_tanggal);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'timestamp');
        $sortDirection = $request->get('sort_direction', 'desc');
        
        $logs = $query->orderBy($sortBy, $sortDirection)
            ->paginate(15)
            ->withQueryString();

        // Stats
        $stats = [
            'total' => LogAktivitas::count(),
            'auth' => LogAktivitas::where(function($q) {
                $q->where('aktivitas', 'like', '%login%')
                  ->orWhere('aktivitas', 'like', '%logout%')
                  ->orWhere('aktivitas', 'like', '%register%');
            })->count(),
            'crud' => LogAktivitas::where(function($q) {
                $q->where('aktivitas', 'like', '%menambah%')
                  ->orWhere('aktivitas', 'like', '%mengubah%')
                  ->orWhere('aktivitas', 'like', '%menghapus%')
                  ->orWhere('aktivitas', 'like', '%membuat%')
                  ->orWhere('aktivitas', 'like', '%edit%')
                  ->orWhere('aktivitas', 'like', '%hapus%')
                  ->orWhere('aktivitas', 'like', '%tambah%');
            })->count(),
            'peminjaman' => LogAktivitas::where(function($q) {
                $q->where('aktivitas', 'like', '%peminjaman%')
                  ->orWhere('aktivitas', 'like', '%pinjam%')
                  ->orWhere('aktivitas', 'like', '%checkout%')
                  ->orWhere('aktivitas', 'like', '%approve%')
                  ->orWhere('aktivitas', 'like', '%reject%')
                  ->orWhere('aktivitas', 'like', '%tolak%')
                  ->orWhere('aktivitas', 'like', '%setuju%');
            })->count(),
            'pengembalian' => LogAktivitas::where(function($q) {
                $q->where('aktivitas', 'like', '%pengembalian%')
                  ->orWhere('aktivitas', 'like', '%kembali%')
                  ->orWhere('aktivitas', 'like', '%return%');
            })->count(),
        ];

        return view('admin.log.index', compact('logs', 'stats'));
    }
}
