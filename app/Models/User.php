<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'user_id');
    }

    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class, 'user_id');
    }

    public function unreadNotifikasi(): HasMany
    {
        return $this->notifikasi()->where('is_read', false);
    }

    public function isAdmin(): bool
    {
        if (!$this->relationLoaded('role')) {
            $this->load('role');
        }
        return $this->role && strtolower($this->role->nama_role) === 'admin';
    }

    public function isPetugas(): bool
    {
        if (!$this->relationLoaded('role')) {
            $this->load('role');
        }
        return $this->role && strtolower($this->role->nama_role) === 'petugas';
    }

    public function isPeminjam(): bool
    {
        if (!$this->relationLoaded('role')) {
            $this->load('role');
        }
        return $this->role && strtolower($this->role->nama_role) === 'peminjam';
    }

    public function hasRole(string ...$roles): bool
    {
        if (!$this->relationLoaded('role')) {
            $this->load('role');
        }
        
        if (!$this->role) {
            return false;
        }
        
        $userRoleName = strtolower($this->role->nama_role);
        
        foreach ($roles as $role) {
            if ($userRoleName === strtolower($role)) {
                return true;
            }
        }
        
        return false;
    }
}
