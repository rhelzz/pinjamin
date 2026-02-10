<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Denda;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $allowedSorts = ['id', 'tanggal_pinjam', 'tanggal_kembali'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }
        
        $peminjamans = Peminjaman::with(['user', 'detail.alat'])
            ->where('status', 'Dipinjam')
            ->orderBy($sortBy, $sortDirection)
            ->paginate(10)
            ->withQueryString();

        return view('petugas.pengembalian.index', compact('peminjamans'));
    }

    public function create(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'Dipinjam') {
            return back()->with('error', 'Peminjaman ini tidak dalam status Dipinjam.');
        }

        $peminjaman->load(['user', 'detail.alat']);
        
        // Ambil daftar denda yang aktif
        $dendas = Denda::aktif()->orderBy('tipe')->orderBy('nama_denda')->get();
        
        // Hitung hari keterlambatan
        $hariTerlambat = 0;
        if ($peminjaman->tanggal_kembali->isPast()) {
            $hariTerlambat = now()->diffInDays($peminjaman->tanggal_kembali);
        }

        return view('petugas.pengembalian.create', compact('peminjaman', 'dendas', 'hariTerlambat'));
    }

    public function store(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'Dipinjam') {
            return back()->with('error', 'Peminjaman ini tidak dalam status Dipinjam.');
        }

        $request->validate([
            'kondisi' => 'required|in:Baik,Rusak',
            'denda' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();

        try {
            // Create pengembalian record
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_dikembalikan' => now()->toDateString(),
                'denda' => $request->denda ?? 0,
                'kondisi' => $request->kondisi,
                'catatan' => $request->catatan,
            ]);

            // Update peminjaman status
            $peminjaman->update([
                'status' => 'Selesai',
                'returned_by' => Auth::id(),
                'returned_at' => now(),
            ]);

            // Return stock
            foreach ($peminjaman->detail as $detail) {
                $alat = Alat::lockForUpdate()->find($detail->alat_id);
                if ($alat) {
                    $alat->stok += $detail->jumlah;
                    $alat->save();

                    // Log damaged items
                    if ($request->kondisi === 'Rusak') {
                        LogAktivitas::create([
                            'user_id' => Auth::id(),
                            'aktivitas' => "Alat {$alat->nama_alat} dikembalikan dalam kondisi RUSAK (Peminjaman #{$peminjaman->id})",
                        ]);
                    }
                }
            }

            // Notify borrower
            $dendaText = $request->denda > 0 ? ' Denda: Rp ' . number_format($request->denda, 0, ',', '.') : '';
            Notifikasi::create([
                'user_id' => $peminjaman->user_id,
                'pesan' => "Pengembalian untuk peminjaman #{$peminjaman->id} telah diproses. Kondisi: {$request->kondisi}.{$dendaText}",
            ]);

            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aktivitas' => "Memproses pengembalian peminjaman #{$peminjaman->id} dari {$peminjaman->user->name} (Kondisi: {$request->kondisi})",
            ]);

            DB::commit();

            return redirect()->route('petugas.pengembalian.index')
                ->with('success', 'Pengembalian berhasil diproses.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
