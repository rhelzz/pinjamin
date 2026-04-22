<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $bukus = Buku::with('genre')
            ->search($request->search)
            ->byGenre($request->genre_id)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $genres = Genre::all();

        return view('peminjam.katalog.index', compact('bukus', 'genres'));
    }

    public function show(Buku $buku)
    {
        $buku->load('genre');
        return view('peminjam.katalog.show', compact('buku'));
    }
}
