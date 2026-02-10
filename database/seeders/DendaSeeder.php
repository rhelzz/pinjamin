<?php

namespace Database\Seeders;

use App\Models\Denda;
use Illuminate\Database\Seeder;

class DendaSeeder extends Seeder
{
    public function run(): void
    {
        $dendas = [
            [
                'nama_denda' => 'Denda Keterlambatan Standar',
                'tipe' => 'per_jam',
                'nominal' => 500, // Rp 500/jam = Rp 12.000/hari
                'deskripsi' => 'Denda untuk keterlambatan pengembalian per jam (Rp 500/jam)',
                'aktif' => true,
            ],
            [
                'nama_denda' => 'Denda Keterlambatan Premium',
                'tipe' => 'per_jam',
                'nominal' => 1000, // Rp 1.000/jam = Rp 24.000/hari
                'deskripsi' => 'Denda untuk keterlambatan alat premium per jam (Rp 1.000/jam)',
                'aktif' => true,
            ],
            [
                'nama_denda' => 'Denda Kerusakan Ringan',
                'tipe' => 'tetap',
                'nominal' => 50000,
                'deskripsi' => 'Denda untuk kerusakan ringan yang masih bisa diperbaiki',
                'aktif' => true,
            ],
            [
                'nama_denda' => 'Denda Kerusakan Sedang',
                'tipe' => 'tetap',
                'nominal' => 150000,
                'deskripsi' => 'Denda untuk kerusakan sedang yang memerlukan perbaikan',
                'aktif' => true,
            ],
            [
                'nama_denda' => 'Denda Kerusakan Berat',
                'tipe' => 'tetap',
                'nominal' => 500000,
                'deskripsi' => 'Denda untuk kerusakan berat atau kehilangan',
                'aktif' => true,
            ],
        ];

        foreach ($dendas as $denda) {
            Denda::updateOrCreate(
                ['nama_denda' => $denda['nama_denda']],
                $denda
            );
        }
    }
}
