<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class, // Sudah diperbarui dengan nomor_telepon sebelumnya
            GenreSeeder::class,
            BukuSeeder::class,
            DendaSeeder::class,
        ]);
    }
}
