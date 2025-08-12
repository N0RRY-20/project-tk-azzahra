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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');

            // Setiap pembayaran melunasi satu tagihan spesifik
            $table->foreignId('id_tagihan')->constrained('tagihan', 'id_tagihan')->onDelete('cascade');

            $table->date('tanggal_bayar');
            $table->integer('jumlah_bayar');
            $table->string('metode_bayar')->nullable(); // Tunai, Transfer
            $table->text('catatan_admin')->nullable();

            // Siapa yang menginput pembayaran ini (Admin)
            $table->foreignId('id_admin')->constrained('users')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
