<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alat extends Model
{
    protected $table = 'alat';

    protected $fillable = [
        'nama_alat',
        'kategori_id',
        'stok',
        'gambar',
        'deskripsi',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function peminjamanDetail(): HasMany
    {
        return $this->hasMany(PeminjamanDetail::class, 'alat_id');
    }

    // Query Scopes
    public function scopeByKategori(Builder $query, ?int $kategoriId): Builder
    {
        return $query->when($kategoriId, fn ($q) => $q->where('kategori_id', $kategoriId));
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->when($search, fn ($q) => $q->where('nama_alat', 'like', "%{$search}%"));
    }

    public function scopeTersedia(Builder $query): Builder
    {
        return $query->where('stok', '>', 0);
    }
}
