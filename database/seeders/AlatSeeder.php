<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    public function run(): void
    {
        $elektronik = Kategori::where('nama_kategori', 'Elektronik')->first();
        $perkakas = Kategori::where('nama_kategori', 'Perkakas')->first();
        $alatUkur = Kategori::where('nama_kategori', 'Alat Ukur')->first();

        $alats = [
            ['nama_alat' => 'Laptop ASUS', 'kategori_id' => $elektronik->id, 'stok' => 10, 'deskripsi' => 'Laptop ASUS untuk kegiatan presentasi dan coding'],
            ['nama_alat' => 'Proyektor Epson', 'kategori_id' => $elektronik->id, 'stok' => 5, 'deskripsi' => 'Proyektor untuk presentasi dan rapat'],
            ['nama_alat' => 'Bor Listrik Bosch', 'kategori_id' => $perkakas->id, 'stok' => 8, 'deskripsi' => 'Bor listrik untuk keperluan bengkel'],
            ['nama_alat' => 'Multimeter Digital', 'kategori_id' => $alatUkur->id, 'stok' => 15, 'deskripsi' => 'Multimeter digital untuk pengukuran tegangan dan arus'],
            ['nama_alat' => 'Oscilloscope Tektronix', 'kategori_id' => $alatUkur->id, 'stok' => 3, 'deskripsi' => 'Oscilloscope untuk analisis sinyal elektronik'],
        ];

        foreach ($alats as $alat) {
            Alat::firstOrCreate(['nama_alat' => $alat['nama_alat']], $alat);
        }
    }
}
