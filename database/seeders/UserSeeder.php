<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator Utama',
                'email' => 'admin@pinjamin.test',
                'nomor_telepon' => '081234567890',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Petugas
        User::updateOrCreate(
            ['username' => 'petugas'],
            [
                'name' => 'Petugas Perpustakaan',
                'email' => 'petugas@pinjamin.test',
                'nomor_telepon' => '082345678901',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Peminjam (User Biasa)
        User::updateOrCreate(
            ['username' => 'peminjam'],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@pinjamin.test',
                'nomor_telepon' => '083456789012',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Tambahan User Peminjam Lainnya
        User::updateOrCreate(
            ['username' => 'ani_wijaya'],
            [
                'name' => 'Ani Wijaya',
                'email' => 'ani@pinjamin.test',
                'nomor_telepon' => '085678901234',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['username' => 'eko_prasetyo'],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko@pinjamin.test',
                'nomor_telepon' => '087890123456',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'status' => 'pending',
                'email_verified_at' => null,
            ]
        );

        User::updateOrCreate(
            ['username' => 'siti_aminah'],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@pinjamin.test',
                'nomor_telepon' => '089012345678',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'status' => 'blacklist',
                'email_verified_at' => now(),
            ]
        );
    }
}
