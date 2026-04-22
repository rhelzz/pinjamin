<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'genre_id',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'stok',
        'deskripsi',
        'gambar',
    ];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function peminjamanDetail(): HasMany
    {
        return $this->hasMany(PeminjamanDetail::class, 'buku_id');
    }

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'buku_id');
    }

    // Query Scopes
    public function scopeByGenre(Builder $query, ?int $genreId): Builder
    {
        return $query->when($genreId, fn ($q) => $q->where('genre_id', $genreId));
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->when($search, fn ($q) => $q->where('judul', 'like', "%{$search}%")->orWhere('penulis', 'like', "%{$search}%"));
    }

    public function scopeTersedia(Builder $query): Builder
    {
        return $query->where('stok', '>', 0);
    }
}
