<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = ['Elektronik', 'Perkakas', 'Alat Ukur'];

        foreach ($kategoris as $k) {
            Kategori::firstOrCreate(['nama_kategori' => $k]);
        }
    }
}
