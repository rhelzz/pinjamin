<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $alats = Alat::with('kategori')
            ->search($request->search)
            ->byKategori($request->kategori_id)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kategoris = Kategori::all();

        return view('admin.alat.index', compact('alats', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['nama_alat', 'kategori_id', 'stok', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat = Alat::create($data);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menambahkan alat: {$alat->nama_alat}",
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan.');
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['nama_alat', 'kategori_id', 'stok', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($alat->gambar) {
                Storage::disk('public')->delete($alat->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat->update($data);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Mengubah alat: {$alat->nama_alat}",
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diperbarui.');
    }

    public function destroy(Alat $alat)
    {
        $nama = $alat->nama_alat;

        if ($alat->gambar) {
            Storage::disk('public')->delete($alat->gambar);
        }

        $alat->delete();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menghapus alat: {$nama}",
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus.');
    }
}
