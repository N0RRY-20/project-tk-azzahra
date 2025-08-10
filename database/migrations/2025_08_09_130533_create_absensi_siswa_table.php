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
        Schema::create('absensi_siswa', function (Blueprint $table) {
            $table->id('id_absensi_siswa');
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('status'); // Hadir, Izin, Sakit, Alpa
            $table->text('keterangan')->nullable();
            $table->timestamps();
    
            // Mencegah siswa diabsen dua kali di hari yang sama
            $table->unique(['id_siswa', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_siswa');
    }
};
