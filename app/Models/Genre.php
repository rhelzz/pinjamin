<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $table = 'genre';

    protected $fillable = ['nama_genre', 'deskripsi'];

    public function buku(): HasMany
    {
        return $this->hasMany(Buku::class, 'genre_id');
    }
}
