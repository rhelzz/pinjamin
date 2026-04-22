<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Booking;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $allowedSorts = ['id', 'tanggal_booking', 'tanggal_kembali', 'status'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }
        
        $bookings = Booking::with(['buku.genre', 'referensiPeminjaman.user'])
            ->where('user_id', Auth::id())
            ->orderBy($sortBy, $sortDirection)
            ->paginate(10)
            ->withQueryString();

        return view('peminjam.booking.index', compact('bookings'));
    }

    public function create(Buku $buku)
    {
        // Cari peminjaman aktif yang menggunakan buku ini
        $activePeminjamans = Peminjaman::with('user')
            ->whereHas('detail', function ($query) use ($buku) {
                $query->where('buku_id', $buku->id);
            })
            ->where('status', 'Dipinjam')
            ->orderBy('tanggal_kembali', 'asc')
            ->get();

        // Cari tanggal kembali tercepat
        $earliestReturn = $activePeminjamans->first();

        return view('peminjam.booking.create', compact('buku', 'activePeminjamans', 'earliestReturn'));
    }

    public function store(Request $request, Buku $buku)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_booking',
            'referensi_peminjaman_id' => 'nullable|exists:peminjaman,id',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Cek apakah user sudah punya booking untuk buku ini yang masih menunggu
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('buku_id', $buku->id)
            ->where('status', 'Menunggu')
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'Anda sudah memiliki booking yang menunggu untuk buku ini.');
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'jumlah' => $request->jumlah,
            'tanggal_booking' => $request->tanggal_booking,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Menunggu',
            'referensi_peminjaman_id' => $request->referensi_peminjaman_id,
            'catatan' => $request->catatan,
        ]);

        // Notify petugas
        $petugasUsers = User::whereHas('role', function($q) {
            $q->whereIn('nama_role', ['Admin', 'Petugas']);
        })->get();
        foreach ($petugasUsers as $petugas) {
            Notifikasi::create([
                'user_id' => $petugas->id,
                'pesan' => 'Booking baru #' . $booking->id . ' dari ' . Auth::user()->name . ' untuk ' . $buku->judul,
            ]);
        }

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Mengajukan booking #{$booking->id} untuk {$buku->judul}",
        ]);

        return redirect()->route('peminjam.booking.index')
            ->with('success', 'Booking berhasil diajukan. Anda akan diberitahu saat buku tersedia.');
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'Menunggu') {
            return back()->with('error', 'Booking tidak dapat dibatalkan.');
        }

        $booking->delete();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Membatalkan booking #{$booking->id}",
        ]);

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}
