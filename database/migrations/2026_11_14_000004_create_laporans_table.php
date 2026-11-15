<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan', 30)->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // pelapor (PJ)
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans')->nullOnDelete();
            $table->foreignId('barang_id')->nullable()->constrained('barangs')->nullOnDelete();
            $table->enum('jenis', ['Ganti Barang Rusak', 'Kebutuhan Barang Baru', 'Barang Rusak', 'Barang Hilang']);
            $table->string('nama_barang', 150);
            $table->text('deskripsi');
            $table->enum('urgensi', ['Biasa', 'Penting', 'Darurat'])->default('Biasa');
            $table->enum('status', ['Menunggu Verifikasi', 'Sedang Diproses', 'Selesai Disetujui', 'Ditolak'])->default('Menunggu Verifikasi');
            $table->string('kondisi_barang', 100)->nullable();
            $table->text('respon_admin')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('foto_bukti')->nullable();
            $table->string('file_lampiran')->nullable();
            $table->timestamp('tanggal_lapor')->useCurrent();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
