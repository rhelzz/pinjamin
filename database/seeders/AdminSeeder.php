<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Admin Seeder - Membuat akun admin saja
 * 
 * Seeder ini hanya membuat:
 * - 3 Role (Admin, Petugas, Peminjam)
 * - 1 User Admin
 * 
 * Gunakan seeder ini untuk setup awal atau reset akun admin
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🔐 Membuat Admin Seeder...');

        // 1. Create Roles
        $this->createRoles();
        
        // 2. Create Admin User
        $this->createAdmin();

        $this->command->info('✅ Admin Seeder selesai!');
        $this->command->newLine();
        $this->command->info('📋 Akun Admin:');
        $this->command->info('   Email    : admin@pinjamin.test');
        $this->command->info('   Username : admin');
        $this->command->info('   Password : password');
    }

    private function createRoles(): void
    {
        $this->command->info('📝 Membuat Roles...');
        
        $roles = ['Admin', 'Petugas', 'Peminjam'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['nama_role' => $role]);
        }
    }

    private function createAdmin(): void
    {
        $this->command->info('👤 Membuat Admin User...');

        User::updateOrCreate(
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
    }
}
