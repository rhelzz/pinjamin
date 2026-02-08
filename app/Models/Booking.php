<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'user_id',
        'alat_id',
        'jumlah',
        'tanggal_booking',
        'tanggal_kembali',
        'status',
        'referensi_peminjaman_id',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_booking' => 'date',
            'tanggal_kembali' => 'date',
            'jumlah' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function referensiPeminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'referensi_peminjaman_id');
    }
}
