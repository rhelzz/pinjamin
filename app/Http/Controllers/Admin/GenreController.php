<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $genres = Genre::withCount('buku')
            ->orderBy($sortBy, $sortDirection)
            ->paginate(15)
            ->withQueryString();
            
        return view('admin.genre.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_genre' => 'required|string|max:255|unique:genre,nama_genre',
        ]);

        $genre = Genre::create($request->only('nama_genre'));

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menambahkan genre: {$genre->nama_genre}",
        ]);

        return redirect()->route('admin.genre.index')
            ->with('success', 'Genre berhasil ditambahkan.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'nama_genre' => 'required|string|max:255|unique:genre,nama_genre,' . $genre->id,
        ]);

        $old = $genre->nama_genre;
        $genre->update($request->only('nama_genre'));

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Mengubah genre: {$old} → {$genre->nama_genre}",
        ]);

        return redirect()->route('admin.genre.index')
            ->with('success', 'Genre berhasil diperbarui.');
    }

    public function destroy(Genre $genre)
    {
        $nama = $genre->nama_genre;
        $genre->delete();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menghapus genre: {$nama}",
        ]);

        return redirect()->route('admin.genre.index')
            ->with('success', 'Genre berhasil dihapus.');
    }
}
