<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Mengubah tanggal_pinjam dan tanggal_kembali dari DATE menjadi DATETIME
     * agar mencatat jam sebagai bagian dari deadline
     */
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Ubah dari date menjadi datetime
            $table->dateTime('tanggal_pinjam')->nullable()->change();
            $table->dateTime('tanggal_kembali')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Kembalikan ke date
            $table->date('tanggal_pinjam')->nullable()->change();
            $table->date('tanggal_kembali')->change();
        });
    }
};
