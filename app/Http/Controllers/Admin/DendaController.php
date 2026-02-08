<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    public function index()
    {
        $dendas = Denda::latest()->paginate(10);
        return view('admin.denda.index', compact('dendas'));
    }

    public function create()
    {
        return view('admin.denda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_denda' => 'required|string|max:255',
            'tipe' => 'required|in:per_hari,tetap',
            'nominal' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string|max:500',
            'aktif' => 'nullable|boolean',
        ]);

        Denda::create([
            'nama_denda' => $request->nama_denda,
            'tipe' => $request->tipe,
            'nominal' => $request->nominal,
            'deskripsi' => $request->deskripsi,
            'aktif' => $request->has('aktif'),
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menambahkan denda: {$request->nama_denda}",
        ]);

        return redirect()->route('admin.denda.index')
            ->with('success', 'Denda berhasil ditambahkan.');
    }

    public function edit(Denda $denda)
    {
        return view('admin.denda.edit', compact('denda'));
    }

    public function update(Request $request, Denda $denda)
    {
        $request->validate([
            'nama_denda' => 'required|string|max:255',
            'tipe' => 'required|in:per_hari,tetap',
            'nominal' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string|max:500',
            'aktif' => 'nullable|boolean',
        ]);

        $denda->update([
            'nama_denda' => $request->nama_denda,
            'tipe' => $request->tipe,
            'nominal' => $request->nominal,
            'deskripsi' => $request->deskripsi,
            'aktif' => $request->has('aktif'),
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Mengubah denda: {$denda->nama_denda}",
        ]);

        return redirect()->route('admin.denda.index')
            ->with('success', 'Denda berhasil diperbarui.');
    }

    public function destroy(Denda $denda)
    {
        $namaDenda = $denda->nama_denda;
        $denda->delete();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menghapus denda: {$namaDenda}",
        ]);

        return redirect()->route('admin.denda.index')
            ->with('success', 'Denda berhasil dihapus.');
    }
}
