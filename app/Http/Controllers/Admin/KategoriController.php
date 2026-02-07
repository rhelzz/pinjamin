<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $kategoris = Kategori::withCount('alat')
            ->orderBy($sortBy, $sortDirection)
            ->paginate(7)
            ->withQueryString();
            
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ]);

        $kategori = Kategori::create($request->only('nama_kategori'));

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menambahkan kategori: {$kategori->nama_kategori}",
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $kategori->id,
        ]);

        $old = $kategori->nama_kategori;
        $kategori->update($request->only('nama_kategori'));

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Mengubah kategori: {$old} → {$kategori->nama_kategori}",
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $nama = $kategori->nama_kategori;
        $kategori->delete();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menghapus kategori: {$nama}",
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
