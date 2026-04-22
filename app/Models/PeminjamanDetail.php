<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeminjamanDetail extends Model
{
    protected $table = 'peminjaman_detail';

    protected $fillable = [
        'peminjaman_id',
        'buku_id',
        'jumlah',
    ];

    protected $casts = [
        'peminjaman_id' => 'integer',
        'buku_id' => 'integer',
        'jumlah' => 'integer',
    ];

    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
