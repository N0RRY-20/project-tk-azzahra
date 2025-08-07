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
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('id_siswa');
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir')->nullable();

            // Foreign Key ke tabel kelas
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->onDelete('restrict');

            // Foreign Key ke tabel users (untuk orang tua), boleh kosong
            $table->foreignId('id_orangtua')->nullable()->unique()->constrained('users')->onDelete('cascade');

            $table->string('kode_aktivasi', 10)->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
