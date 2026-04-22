<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $fiksi = Genre::where('nama_genre', 'Fiksi')->first();
        $teknologi = Genre::where('nama_genre', 'Teknologi')->first();
        $pelajaran = Genre::where('nama_genre', 'Pelajaran')->first();

        $bukus = [
            [
                'judul' => 'Laskar Pelangi',
                'genre_id' => $fiksi->id,
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => '2005',
                'isbn' => '979-3062-79-7',
                'stok' => 10,
                'deskripsi' => 'Novel tentang kehidupan anak-anak di Belitung.',
            ],
            [
                'judul' => 'Clean Code',
                'genre_id' => $teknologi->id,
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => '2008',
                'isbn' => '978-0132350884',
                'stok' => 5,
                'deskripsi' => 'A Handbook of Agile Software Craftsmanship.',
            ],
            [
                'judul' => 'Buku Pintar Matematika',
                'genre_id' => $pelajaran->id,
                'penulis' => 'Ahmad Faisal',
                'penerbit' => 'Erlangga',
                'tahun_terbit' => '2020',
                'isbn' => '978-602-298-123-4',
                'stok' => 15,
                'deskripsi' => 'Buku panduan belajar matematika untuk SMA.',
            ],
            [
                'judul' => 'The Pragmatic Programmer',
                'genre_id' => $teknologi->id,
                'penulis' => 'Andrew Hunt',
                'penerbit' => 'Addison-Wesley',
                'tahun_terbit' => '1999',
                'isbn' => '020161622X',
                'stok' => 8,
                'deskripsi' => 'Your journey to mastery in software engineering.',
            ],
        ];

        foreach ($bukus as $buku) {
            Buku::firstOrCreate(['judul' => $buku['judul']], $buku);
        }
    }
}
