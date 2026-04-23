<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $fiksi = Genre::where('nama_genre', 'Fiksi')->first()?->id ?? 1;
        $teknologi = Genre::where('nama_genre', 'Teknologi')->first()?->id ?? 3;

        $books = [
            [
                'judul' => 'Laskar Pelangi',
                'genre_id' => $fiksi,
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'isbn' => '9793062797',
                'stok' => 10,
                'deskripsi' => 'Kisah perjuangan 10 anak di Belitung.',
            ],
            [
                'judul' => 'Clean Code',
                'genre_id' => $teknologi,
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'isbn' => '9780132350884',
                'stok' => 5,
                'deskripsi' => 'Panduan menulis kode yang bersih dan profesional.',
            ],
            [
                'judul' => 'Filosofi Teras',
                'genre_id' => $fiksi,
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => 2019,
                'isbn' => '9786024125189',
                'stok' => 15,
                'deskripsi' => 'Pengenalan Stoisisme untuk kehidupan modern.',
            ],
        ];

        foreach ($books as $book) {
            Buku::updateOrCreate(['judul' => $book['judul']], $book);
        }
    }
}
