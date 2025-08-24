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
        Schema::create('atp', function (Blueprint $table) {
            $table->id('id_atp');
            $table->string('tahun_ajaran'); // Contoh: "2025/2026"
            $table->string('semester'); // Ganjil atau Genap
            $table->string('fase_perkembangan'); // Contoh: "Fase Fondasi Usia 5-6 Tahun"
            $table->string('elemen_kurikulum'); // Contoh: "Jati Diri", "Literasi dan STEAM"
            $table->text('tujuan_pembelajaran');
            $table->integer('urutan')->default(0); // Untuk mengurutkan tujuan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atp');
    }
};
