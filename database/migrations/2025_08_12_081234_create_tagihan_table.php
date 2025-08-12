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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id('id_tagihan');

            // Setiap tagihan dimiliki oleh satu siswa
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');

            $table->string('deskripsi'); // Contoh: "SPP Bulan Juli 2025"
            $table->integer('jumlah_tagihan');
            $table->date('tanggal_jatuh_tempo');

            // Status untuk melacak apakah sudah lunas atau belum
            $table->string('status')->default('Belum Lunas'); // Belum Lunas, Lunas, Sebagian

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
