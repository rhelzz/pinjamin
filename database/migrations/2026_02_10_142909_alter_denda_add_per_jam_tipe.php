<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan tipe 'per_jam' untuk mendukung denda per jam
     */
    public function up(): void
    {
        // Update enum untuk menambahkan 'per_jam'
        DB::statement("ALTER TABLE denda MODIFY COLUMN tipe ENUM('per_jam', 'per_hari', 'tetap') DEFAULT 'per_jam'");
        
        // Update existing 'per_hari' records to 'per_jam' and adjust nominal
        // Konversi: denda per hari / 24 jam = denda per jam
        DB::table('denda')
            ->where('tipe', 'per_hari')
            ->update([
                'tipe' => 'per_jam',
                'nominal' => DB::raw('ROUND(nominal / 24, 0)'),
                'deskripsi' => DB::raw("REPLACE(deskripsi, 'per hari', 'per jam')")
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Konversi kembali per_jam ke per_hari
        DB::table('denda')
            ->where('tipe', 'per_jam')
            ->update([
                'tipe' => 'per_hari',
                'nominal' => DB::raw('nominal * 24'),
                'deskripsi' => DB::raw("REPLACE(deskripsi, 'per jam', 'per hari')")
            ]);
            
        DB::statement("ALTER TABLE denda MODIFY COLUMN tipe ENUM('per_hari', 'tetap') DEFAULT 'per_hari'");
    }
};
