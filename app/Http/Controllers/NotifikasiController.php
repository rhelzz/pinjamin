<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Notifikasi::where('user_id', Auth::id());

        // Filter by kategori (based on pesan content)
        if ($request->filled('kategori')) {
            $kategori = $request->kategori;
            switch ($kategori) {
                case 'peminjaman':
                    $query->where(function ($q) {
                        $q->where('pesan', 'like', '%peminjaman%')
                          ->orWhere('pesan', 'like', '%pinjam%')
                          ->orWhere('pesan', 'like', '%disetujui%')
                          ->orWhere('pesan', 'like', '%ditolak%')
                          ->orWhere('pesan', 'like', '%approve%');
                    });
                    break;
                case 'pengembalian':
                    $query->where(function ($q) {
                        $q->where('pesan', 'like', '%pengembalian%')
                          ->orWhere('pesan', 'like', '%dikembalikan%')
                          ->orWhere('pesan', 'like', '%kembali%');
                    });
                    break;
                case 'denda':
                    $query->where(function ($q) {
                        $q->where('pesan', 'like', '%denda%')
                          ->orWhere('pesan', 'like', '%terlambat%')
                          ->orWhere('pesan', 'like', '%keterlambatan%');
                    });
                    break;
                case 'sistem':
                    $query->where(function ($q) {
                        $q->where('pesan', 'like', '%sistem%')
                          ->orWhere('pesan', 'like', '%akun%')
                          ->orWhere('pesan', 'like', '%welcome%')
                          ->orWhere('pesan', 'like', '%selamat datang%');
                    });
                    break;
            }
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        // Stats for current user
        $stats = [
            'total' => Notifikasi::where('user_id', Auth::id())->count(),
            'unread' => Notifikasi::where('user_id', Auth::id())->where('is_read', false)->count(),
            'read' => Notifikasi::where('user_id', Auth::id())->where('is_read', true)->count(),
        ];

        $notifikasis = $query->latest()->paginate(15);

        return view('notifikasi.index', compact('notifikasis', 'stats'));
    }

    public function markRead($id)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())->findOrFail($id);
        $notifikasi->update(['is_read' => true]);

        return back()->with('success', 'Notifikasi telah dibaca.');
    }

    public function markAllRead()
    {
        Notifikasi::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'Semua notifikasi telah dibaca.');
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())->findOrFail($id);
        $notifikasi->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    public function destroyAll()
    {
        Notifikasi::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Semua notifikasi berhasil dihapus.');
    }
}
