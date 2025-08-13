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
        Schema::table('pendaftaran_lomba', function (Blueprint $table) {
            // Kolom ini akan ditambahkan setelah 'nama_pendaftar'
            $table->string('status_pendaftar')->after('nama_pendaftar'); // Ayah atau Bunda
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_lomba', function (Blueprint $table) {
            //
        });
    }
};
