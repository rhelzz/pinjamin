<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * 
     * Opsi Cara Menjalankan:
     * 
     * 1. Data dasar saja (default):
     *    php artisan db:seed
     * 
     * 2. Admin saja:
     *    php artisan db:seed --class=AdminSeeder
     * 
     * 3. Data lengkap/komprehensif:
     *    php artisan db:seed --class=ComprehensiveSeeder
     * 
     * 4. Fresh migrate dengan data komprehensif:
     *    php artisan migrate:fresh --seed --seeder=ComprehensiveSeeder
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            KategoriSeeder::class,
            AlatSeeder::class,
            DendaSeeder::class,
        ]);
    }
}
