<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $alats = Alat::with('kategori')
            ->search($request->search)
            ->byKategori($request->kategori_id)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $kategoris = Kategori::all();

        return view('peminjam.katalog.index', compact('alats', 'kategoris'));
    }

    public function show(Alat $alat)
    {
        $alat->load('kategori');
        return view('peminjam.katalog.show', compact('alat'));
    }
}
