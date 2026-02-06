<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isPetugas()) {
            return redirect()->route('petugas.dashboard');
        } else {
            return redirect()->route('peminjam.dashboard');
        }
    }

    public function admin()
    {
        $totalUsers = \App\Models\User::count();
        $totalAlat = \App\Models\Alat::count();
        $totalKategori = \App\Models\Kategori::count();
        $totalPeminjaman = \App\Models\Peminjaman::count();
        $recentLogs = \App\Models\LogAktivitas::with('user')->latest('timestamp')->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalAlat', 'totalKategori', 'totalPeminjaman', 'recentLogs'));
    }

    public function petugas()
    {
        $pendingCount = \App\Models\Peminjaman::where('status', 'Pending')->count();
        $dipinjamCount = \App\Models\Peminjaman::where('status', 'Dipinjam')->count();
        $selesaiCount = \App\Models\Peminjaman::where('status', 'Selesai')->count();

        return view('petugas.dashboard', compact('pendingCount', 'dipinjamCount', 'selesaiCount'));
    }

    public function peminjam()
    {
        $user = Auth::user();
        $peminjamanAktif = \App\Models\Peminjaman::where('user_id', $user->id)
            ->whereIn('status', ['Pending', 'Dipinjam'])
            ->count();
        $totalPeminjaman = \App\Models\Peminjaman::where('user_id', $user->id)->count();

        return view('peminjam.dashboard', compact('peminjamanAktif', 'totalPeminjaman'));
    }
}
