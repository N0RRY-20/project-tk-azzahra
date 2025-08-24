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
        Schema::create('rpph', function (Blueprint $table) {
            $table->id('id_rpph');
            $table->foreignId('id_rppm')->constrained('rppm', 'id_rppm')->onDelete('cascade');
            $table->date('tanggal');
            $table->text('kegiatan_pembuka')->nullable();
            $table->text('kegiatan_inti')->nullable();
            $table->text('kegiatan_penutup')->nullable();
            $table->text('alat_dan_bahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpph');
    }
};
