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
        Schema::table('siswa', function (Blueprint $table) {
            // Kolom ini akan ditambahkan setelah 'telepon_orangtua'
            $table->text('riwayat_kesehatan')->nullable()->after('telepon_orangtua');
            $table->text('catatan_khusus_ortu')->nullable()->after('riwayat_kesehatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn(['riwayat_kesehatan', 'catatan_khusus_ortu']);
        });
    }
};
