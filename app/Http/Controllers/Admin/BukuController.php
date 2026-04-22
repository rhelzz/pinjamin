<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Genre;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $bukus = Buku::with('genre')
            ->search($request->search)
            ->byGenre($request->genre_id)
            ->orderBy($sortBy, $sortDirection)
            ->paginate(15)
            ->withQueryString();

        $genres = Genre::all();

        return view('admin.buku.index', compact('bukus', 'genres'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.buku.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre_id' => 'required|exists:genre,id',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['judul', 'genre_id', 'stok', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        $buku = Buku::create($data);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menambahkan buku: {$buku->judul}",
        ]);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        $genres = Genre::all();
        return view('admin.buku.edit', compact('buku', 'genres'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre_id' => 'required|exists:genre,id',
            'penulis' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'nullable|string|max:20|unique:buku,isbn,' . $buku->id,
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['judul', 'genre_id', 'penulis', 'penerbit', 'tahun_terbit', 'isbn', 'stok', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($buku->gambar) {
                Storage::disk('public')->delete($buku->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        $buku->update($data);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Mengubah buku: {$buku->judul}",
        ]);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $nama = $buku->judul;

        if ($buku->gambar) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menghapus buku: {$nama}",
        ]);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
