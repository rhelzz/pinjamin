<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
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
        
        $bookings = Booking::with(['alat.kategori', 'referensiPeminjaman.user'])
            ->where('user_id', Auth::id())
            ->orderBy($sortBy, $sortDirection)
            ->paginate(10)
            ->withQueryString();

        return view('peminjam.booking.index', compact('bookings'));
    }

    public function create(Alat $alat)
    {
        // Cari peminjaman aktif yang menggunakan alat ini
        $activePeminjamans = Peminjaman::with('user')
            ->whereHas('detail', function ($query) use ($alat) {
                $query->where('alat_id', $alat->id);
            })
            ->where('status', 'Dipinjam')
            ->orderBy('tanggal_kembali', 'asc')
            ->get();

        // Cari tanggal kembali tercepat
        $earliestReturn = $activePeminjamans->first();

        return view('peminjam.booking.create', compact('alat', 'activePeminjamans', 'earliestReturn'));
    }

    public function store(Request $request, Alat $alat)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_booking',
            'referensi_peminjaman_id' => 'nullable|exists:peminjaman,id',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Cek apakah user sudah punya booking untuk alat ini yang masih menunggu
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('alat_id', $alat->id)
            ->where('status', 'Menunggu')
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'Anda sudah memiliki booking yang menunggu untuk alat ini.');
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'alat_id' => $alat->id,
            'jumlah' => $request->jumlah,
            'tanggal_booking' => $request->tanggal_booking,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Menunggu',
            'referensi_peminjaman_id' => $request->referensi_peminjaman_id,
            'catatan' => $request->catatan,
        ]);

        // Notify petugas
        $petugasUsers = User::whereIn('role_id', [1, 2])->get();
        foreach ($petugasUsers as $petugas) {
            Notifikasi::create([
                'user_id' => $petugas->id,
                'pesan' => 'Booking baru #' . $booking->id . ' dari ' . Auth::user()->name . ' untuk ' . $alat->nama_alat,
            ]);
        }

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Mengajukan booking #{$booking->id} untuk {$alat->nama_alat}",
        ]);

        return redirect()->route('peminjam.booking.index')
            ->with('success', 'Booking berhasil diajukan. Anda akan diberitahu saat alat tersedia.');
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
