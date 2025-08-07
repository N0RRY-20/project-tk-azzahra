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
        Schema::create('laporan_perkembangan', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');

            // Foreign Keys
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('guru_profils', 'id_guru')->onDelete('restrict');
            $table->foreignId('id_aspek')->constrained('aspek_penilaian', 'id_aspek')->onDelete('restrict');

            // Kolom lainnya
            $table->string('capaian');
            $table->text('catatan_guru')->nullable();
            $table->date('tanggal_laporan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_perkembangan');
    }
};
