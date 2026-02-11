<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure roles are created in specific order with specific IDs
        $roles = [
            ['id' => 1, 'nama_role' => 'Admin'],
            ['id' => 2, 'nama_role' => 'Petugas'],
            ['id' => 3, 'nama_role' => 'Peminjam'],
        ];

        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['id' => $roleData['id']],
                ['nama_role' => $roleData['nama_role']]
            );
        }
    }
}
