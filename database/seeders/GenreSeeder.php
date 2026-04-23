<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['nama_genre' => 'Fiksi'],
            ['nama_genre' => 'Non-Fiksi'],
            ['nama_genre' => 'Teknologi'],
            ['nama_genre' => 'Sains'],
            ['nama_genre' => 'Sejarah'],
            ['nama_genre' => 'Novel'],
            ['nama_genre' => 'Komik'],
            ['nama_genre' => 'Religi'],
            ['nama_genre' => 'Biografi'],
        ];

        foreach ($genres as $genre) {
            Genre::updateOrCreate(['nama_genre' => $genre['nama_genre']], $genre);
        }
    }
}
