<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $viewMode = $request->get('view', 'card'); // Default ke card
        
        // Tentukan jumlah per halaman berdasarkan view mode
        $perPage = ($viewMode === 'table') ? 10 : 4;

        $bukus = Buku::with('genre')
            ->search($request->search)
            ->byGenre($request->genre_id)
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage)
            ->withQueryString();

        // Enkripsi ID untuk setiap buku
        $bukus->getCollection()->transform(function ($buku) {
            $buku->encrypted_id = Crypt::encryptString($buku->id);
            return $buku;
        });

        $genres = Genre::all();

        if ($request->ajax()) {
            return view('peminjam.katalog._list', compact('bukus', 'viewMode'))->render();
        }

        return view('peminjam.katalog.index', compact('bukus', 'genres', 'viewMode'));
    }

    public function show($encrypted_id)
    {
        try {
            $id = Crypt::decryptString($encrypted_id);
            $buku = Buku::with('genre')->findOrFail($id);
            return view('peminjam.katalog.show', compact('buku'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function cartOverlay()
    {
        return view('peminjam.katalog._cart_overlay')->render();
    }
}
