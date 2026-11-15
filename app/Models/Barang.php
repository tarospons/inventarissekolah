<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'kategori_id',
        'ruangan_id',
        'jumlah',
        'satuan',
        'kondisi',
        'status_ketersediaan',
        'nilai_perolehan',
        'tahun_pengadaan',
        'foto',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
            'nilai_perolehan' => 'decimal:2',
            'tahun_pengadaan' => 'integer',
        ];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class, 'barang_id');
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('storage/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/default-barang.svg');
    }

    public function getKondisiBadgeClassAttribute(): string
    {
        return match ($this->kondisi) {
            'Baik' => 'badge-status-baik',
            'Rusak Ringan' => 'badge-status-ringan',
            'Rusak Berat' => 'badge-status-berat',
            default => 'badge bg-secondary text-white',
        };
    }
}
