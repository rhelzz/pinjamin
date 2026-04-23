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
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $viewMode = $request->get('view', 'card'); // Default ke card
        
        // Tentukan jumlah per halaman
        $perPage = 4;

        $bukus = Buku::with('genre')
            ->search($request->search)
            ->byGenre($request->genre_id)
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage)
            ->withQueryString();

        $genres = Genre::all();

        if ($request->ajax()) {
            return view('peminjam.katalog._list', compact('bukus', 'viewMode'))->render();
        }

        return view('peminjam.katalog.index', compact('bukus', 'genres', 'viewMode'));
    }

    public function show(Buku $buku)
    {
        $buku->load('genre');
        return view('peminjam.katalog.show', compact('buku'));
    }
}
