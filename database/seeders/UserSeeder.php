<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@pinjamin.test',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['username' => 'petugas'],
            [
                'name' => 'Petugas',
                'email' => 'petugas@pinjamin.test',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['username' => 'peminjam'],
            [
                'name' => 'Peminjam',
                'email' => 'peminjam@pinjamin.test',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
    }
}
