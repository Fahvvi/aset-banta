<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Relasi
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();

            // UBAH TIPE DATA DI SINI (date -> dateTime)
            $table->dateTime('tanggal_mulai');   
            $table->dateTime('tanggal_selesai'); 
            
            $table->text('keperluan')->nullable();

            // Status
            $table->enum('status', ['pending', 'approved', 'rejected', 'returned'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};