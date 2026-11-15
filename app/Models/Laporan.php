<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_laporan',
        'user_id',
        'ruangan_id',
        'barang_id',
        'jenis',
        'nama_barang',
        'deskripsi',
        'urgensi',
        'status',
        'kondisi_barang',
        'respon_admin',
        'admin_id',
        'foto_bukti',
        'file_lampiran',
        'tanggal_lapor',
        'tanggal_selesai',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lapor' => 'datetime',
            'tanggal_selesai' => 'datetime',
        ];
    }

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'Selesai Disetujui' => 'badge-status-baik',
            'Sedang Diproses' => 'badge-status-ringan',
            'Ditolak' => 'badge-status-berat',
            default => 'badge bg-warning text-dark',
        };
    }

    public function getJenisBadgeStyleAttribute(): string
    {
        return match ($this->jenis) {
            'Ganti Barang Rusak' => 'background: #fef3c7; color: #b45309;',
            'Kebutuhan Barang Baru' => 'background: #e0f2fe; color: #0284c7;',
            'Barang Hilang' => 'background: #fef2f2; color: #991b1b;',
            default => 'background: #fee2e2; color: #b91c1c;',
        };
    }

    public function getJenisIconAttribute(): string
    {
        return match ($this->jenis) {
            'Ganti Barang Rusak' => 'published_with_changes',
            'Kebutuhan Barang Baru' => 'add_shopping_cart',
            'Barang Hilang' => 'search_off',
            default => 'build',
        };
    }
}
