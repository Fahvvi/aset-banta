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
        Schema::table('members', function (Blueprint $table) {
        // Menambahkan kolom avatar setelah kolom nama. Nullable artinya boleh kosong.
        $table->string('avatar')->nullable()->after('nama');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
         $table->dropColumn('avatar');
    });
    }
};
