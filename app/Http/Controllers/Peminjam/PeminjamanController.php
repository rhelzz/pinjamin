<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['detail.alat', 'pengembalian'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function show(Peminjaman $peminjaman)
    {
        if ($peminjaman->user_id !== Auth::id()) {
            abort(403);
        }

        $peminjaman->load(['detail.alat.kategori', 'pengembalian', 'user', 'approver', 'returner']);

        return view('peminjam.peminjaman.show', compact('peminjaman'));
    }
}
