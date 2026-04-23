<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'nama_role' => 'Admin'],
            ['id' => 2, 'nama_role' => 'Petugas'],
            ['id' => 3, 'nama_role' => 'Peminjam'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }
    }
}
