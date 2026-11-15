<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('nama', 150);
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->nullOnDelete();
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans')->nullOnDelete();
            $table->integer('jumlah')->default(1);
            $table->string('satuan', 30)->default('Unit');
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Afkir'])->default('Baik');
            $table->enum('status_ketersediaan', ['Tersedia', 'Dipinjam', 'Dalam Perbaikan', 'Afkir'])->default('Tersedia');
            $table->decimal('nilai_perolehan', 15, 2)->default(0);
            $table->year('tahun_pengadaan')->nullable();
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
