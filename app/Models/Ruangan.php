<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'sub',
        'icon',
        'gedung',
        'lantai',
        'pj_id',
        'catatan',
    ];

    public function pj(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pj_id');
    }

    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'ruangan_id');
    }

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class, 'ruangan_id');
    }

    public function getTotalAsetAttribute(): int
    {
        return (int) $this->barangs()->sum('jumlah');
    }

    public function getBaikCountAttribute(): int
    {
        return (int) $this->barangs()->where('kondisi', 'Baik')->sum('jumlah');
    }

    public function getRusakCountAttribute(): int
    {
        return (int) $this->barangs()->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat', 'Afkir'])->sum('jumlah');
    }

    public function getPersentaseBaikAttribute(): float
    {
        $total = $this->total_aset;
        if ($total === 0) return 100.0;
        return round(($this->baik_count / $total) * 100, 1);
    }
}
