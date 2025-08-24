<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Panggil seeder tanpa ketergantungan dulu
            KelasSeeder::class,
            AspekPenilaianSeeder::class,
            // Baru panggil seeder yang punya ketergantungan
            UserSiswaGuruSeeder::class,
            JadwalKegiatanSeeder::class,
            PengumumanEventSeeder::class,
            TagihanSeeder::class,
            KurikulumSeeder::class,
        ]);
    }
}
