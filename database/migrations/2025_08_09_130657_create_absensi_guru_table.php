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
        Schema::create('absensi_guru', function (Blueprint $table) {
            $table->id('id_absensi_guru');
            $table->foreignId('id_guru')->constrained('guru_profils', 'id_guru')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('status'); // Hadir, Izin, Sakit, Alpa
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            // Mencegah guru diabsen dua kali di hari yang sama
            $table->unique(['id_guru', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_guru');
    }
};
