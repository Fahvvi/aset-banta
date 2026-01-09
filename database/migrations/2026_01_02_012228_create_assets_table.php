<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            
            // TAMBAHAN: Kolom Kategori (Penting untuk fitur filter di Landing Page)
            $table->string('kategori')->default('lainnya'); 

            $table->date('tanggal_pembelian');
            $table->decimal('harga_beli', 15, 2);
            $table->enum('status_alat', ['Baik', 'Ada Robek', 'Rusak']);
            $table->string('posisi_awal');
            
            // Relasi Peminjam Terbaru
            $table->foreignId('peminjam_terbaru_id')->nullable()->constrained('members')->nullOnDelete();
            
            // Ini sudah benar dateTime, tidak perlu diubah
            $table->dateTime('waktu_peminjaman')->nullable();
            
            $table->boolean('sudah_dikembalikan')->default(true);
            $table->string('foto_alat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};