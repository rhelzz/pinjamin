<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Genre;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BookingConflictUseCaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Siapkan User Peminjam (Yang akan menahan buku hingga terlambat)
        $userOverdue = User::updateOrCreate(
            ['username' => 'peminjam_telat'],
            [
                'name' => 'Si Peminjam Telat',
                'email' => 'telat@pinjamin.test',
                'nomor_telepon' => '081111111111',
                'password' => Hash::make('password'),
                'role_id' => 3, // Peminjam
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 2. Siapkan Buku Target
        $genre = Genre::firstOrCreate(['nama_genre' => 'Fiksi']);
        $bukuKonflik = Buku::updateOrCreate(
            ['judul' => 'Buku Konflik Booking'],
            [
                'genre_id' => $genre->id,
                'penulis' => 'Admin Pinjamin',
                'penerbit' => 'Pinjamin Press',
                'tahun_terbit' => date('Y'),
                'isbn' => '999-999-999-999-9',
                'stok' => 0, // Stok dibuat 0 karena sedang dipinjam
                'deskripsi' => 'Buku ini sengaja dibuat untuk mengetes fitur notifikasi konflik booking saat buku sedang ditahan (terlambat dikembalikan) oleh user lain.',
            ]
        );

        // 3. Buat Data Peminjaman yang Terlambat (Overdue)
        // Misal: Dipinjam 10 hari yang lalu, seharusnya kembali 3 hari yang lalu
        $peminjaman = Peminjaman::create([
            'user_id' => $userOverdue->id,
            'tanggal_pinjam' => now()->subDays(10)->format('Y-m-d'),
            'tanggal_kembali' => now()->subDays(3)->format('Y-m-d'), // SUDAH LEWAT (TERLAMBAT)
            'status' => 'Dipinjam',
        ]);

        // 4. Masukkan Detail Peminjaman (Buku Konflik)
        PeminjamanDetail::create([
            'peminjaman_id' => $peminjaman->id,
            'buku_id' => $bukuKonflik->id,
            'jumlah' => 1,
        ]);

        $this->command->info('Usecase Konflik Booking Berhasil Dibuat!');
        $this->command->info('1. Buku "Buku Konflik Booking" telah dibuat dengan stok 0.');
        $this->command->info('2. User "Si Peminjam Telat" sedang meminjam buku tersebut dan terlambat mengembalikan sejak 3 hari lalu.');
        $this->command->info('3. Login sebagai peminjam lain (misal: Budi / username: peminjam) dan coba booking buku tersebut untuk melihat peringatan konfliknya!');
    }
}
