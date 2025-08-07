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
        Schema::create('guru_profils', function (Blueprint $table) {
            // Kolom id_guru
            $table->bigIncrements('id_guru');

            // Foreign Key ke tabel users
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');

            // Kolom lainnya
            $table->string('nama_lengkap');
            $table->string('telepon', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_profil');
    }
};
