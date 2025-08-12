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
        Schema::create('buku_komunikasi', function (Blueprint $table) {
            $table->id('id_komunikasi');

            // Setiap pesan terikat pada satu siswa
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');

            // Setiap pesan memiliki satu pengirim (dari tabel users)
            $table->foreignId('id_pengirim')->constrained('users')->onDelete('cascade');

            // Isi pesan
            $table->text('pesan');

            // Untuk fitur notifikasi di masa depan (opsional)
            $table->boolean('sudah_dibaca')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_komunikasi');
    }
};
