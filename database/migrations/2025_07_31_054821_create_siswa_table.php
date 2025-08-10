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
    
            // TAMBAHKAN KOLOM INI
            $table->string('telepon_orangtua', 20)->nullable();
    
            // Foreign Keys
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->onDelete('restrict');
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
