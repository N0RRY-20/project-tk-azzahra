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
        Schema::create('pendaftaran_lomba', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->foreignId('id_lomba')->constrained('event_lomba', 'id_lomba')->onDelete('cascade');
            $table->foreignId('id_orangtua')->constrained('users')->onDelete('cascade');
            $table->string('nama_pendaftar'); // Misal: "Bunda Ani (Kelas A)"
            $table->timestamps();

            // Mencegah satu orang tua mendaftar dua kali di lomba yang sama
            $table->unique(['id_lomba', 'id_orangtua']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_lomba');
    }
};
