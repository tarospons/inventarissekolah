<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nip',
        'jabatan',
        'jurusan',
        'kontak',
        'foto_profil',
        'is_active',
        'last_seen_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function getIsOnlineAttribute(): bool
    {
        return $this->last_seen_at !== null && $this->last_seen_at->gt(now()->subMinutes(5));
    }

    public function ruangans(): HasMany
    {
        return $this->hasMany(Ruangan::class, 'pj_id');
    }

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class, 'user_id');
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->foto_profil)) {
            return asset('storage/' . $this->foto_profil);
        }
        $initials = $this->initials;
        $bg = $this->role === 'admin' ? '%23002366' : ($this->role === 'kepsek' ? '%230f172a' : '%230284c7');
        return "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'><rect width='100%' height='100%' fill='{$bg}'/><text x='50%' y='54%' font-family='Arial,sans-serif' font-weight='700' font-size='28' fill='%23ffffff' dominant-baseline='middle' text-anchor='middle'>{$initials}</text></svg>";
    }

    public function getInitialsAttribute(): string
    {
        $words = explode(' ', trim($this->name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= strtoupper(substr($w, 0, 1));
        }
        return $initials ?: 'PJ';
    }
}
