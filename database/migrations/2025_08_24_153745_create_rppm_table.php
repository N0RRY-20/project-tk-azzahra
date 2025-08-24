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
        Schema::create('rppm', function (Blueprint $table) {
            $table->id('id_rppm');
            $table->foreignId('id_guru')->constrained('guru_profils', 'id_guru')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->onDelete('cascade');
            $table->string('tahun_ajaran'); // Contoh: "2025/2026"
            $table->string('semester'); // Ganjil atau Genap
            $table->string('bulan');
            $table->integer('minggu_ke');
            $table->string('tema');
            $table->string('sub_tema');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rppm');
    }
};
