<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            
            // --- IDENTITAS ---
            $table->string('nama');
            $table->string('nomor_hp')->nullable();
            $table->string('generasi')->nullable();
            $table->string('status')->default('Aktif'); // Default Aktif
            
            // --- ALAMAT LENGKAP ---
            $table->text('alamat')->nullable();    // Ini yang tadi bikin error (missing column)
            $table->string('desa')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};