<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Database\Seeder;

class TagihanSeeder extends Seeder
{
    public function run(): void
    {
        $siswaBudi = Siswa::where('nama_lengkap', 'Budi Santoso')->first();
        if ($siswaBudi) {
            // Buat tagihan SPP
            $tagihan = Tagihan::create([
                'id_siswa' => $siswaBudi->id_siswa,
                'deskripsi' => 'SPP Bulan Agustus 2025',
                'jumlah_tagihan' => 300000,
                'tanggal_jatuh_tempo' => '2025-08-10',
                'status' => 'Belum Lunas'
            ]);
        }
    }
}
