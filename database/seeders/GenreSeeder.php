<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['nama_genre' => 'Fiksi', 'deskripsi' => 'Buku fiksi dan sastra'],
            ['nama_genre' => 'Non-Fiksi', 'deskripsi' => 'Buku non-fiksi dan biografi'],
            ['nama_genre' => 'Pelajaran', 'deskripsi' => 'Buku pelajaran sekolah dan kuliah'],
            ['nama_genre' => 'Teknologi', 'deskripsi' => 'Buku tentang komputer, IT, dan programming'],
        ];

        foreach ($genres as $genre) {
            Genre::firstOrCreate(['nama_genre' => $genre['nama_genre']], $genre);
        }
    }
}
