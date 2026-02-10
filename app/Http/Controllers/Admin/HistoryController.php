<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'detail.alat', 'pengembalian', 'approver', 'returner']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Search by user name/username
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('username', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        
        $allowedSorts = ['id', 'created_at', 'status', 'tanggal_pinjam', 'tanggal_kembali'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }
        
        $peminjamans = $query->orderBy($sortBy, $sortDirection)->paginate(15)->withQueryString();

        // Get all users for filter dropdown
        $users = User::where('role_id', 3)->orderBy('name')->get();

        // Stats
        $stats = [
            'total' => Peminjaman::count(),
            'pending' => Peminjaman::where('status', 'Pending')->count(),
            'dipinjam' => Peminjaman::where('status', 'Dipinjam')->count(),
            'selesai' => Peminjaman::where('status', 'Selesai')->count(),
            'ditolak' => Peminjaman::where('status', 'Ditolak')->count(),
        ];

        return view('admin.history.index', compact('peminjamans', 'users', 'stats'));
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'detail.alat.kategori', 'pengembalian', 'approver', 'returner']);
        return view('admin.history.show', compact('peminjaman'));
    }
}
