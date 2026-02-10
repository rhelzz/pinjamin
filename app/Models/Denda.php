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

    public function scopePerJam(Builder $query): Builder
    {
        return $query->where('tipe', 'per_jam');
    }

    public function scopePerHari(Builder $query): Builder
    {
        return $query->where('tipe', 'per_hari');
    }

    public function scopeTetap(Builder $query): Builder
    {
        return $query->where('tipe', 'tetap');
    }

    /**
     * Hitung denda berdasarkan jam keterlambatan
     */
    public function hitungDenda(int $jamTerlambat): float
    {
        if ($this->tipe === 'per_jam') {
            return max(0, $this->nominal * $jamTerlambat);
        } elseif ($this->tipe === 'per_hari') {
            // Convert jam ke hari (ceiling)
            $hariTerlambat = (int) ceil($jamTerlambat / 24);
            return max(0, $this->nominal * $hariTerlambat);
        }
        // tetap
        return max(0, $this->nominal);
    }
}
