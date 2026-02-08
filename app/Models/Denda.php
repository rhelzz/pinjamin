<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'denda';

    protected $fillable = [
        'nama_denda',
        'tipe',
        'nominal',
        'deskripsi',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'nominal' => 'decimal:2',
            'aktif' => 'boolean',
        ];
    }

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('aktif', true);
    }

    public function scopePerHari(Builder $query): Builder
    {
        return $query->where('tipe', 'per_hari');
    }

    public function scopeTetap(Builder $query): Builder
    {
        return $query->where('tipe', 'tetap');
    }
}
