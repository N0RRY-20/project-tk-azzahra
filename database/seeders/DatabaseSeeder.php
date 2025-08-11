<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Panggil seeder tanpa ketergantungan dulu
            KelasSeeder::class,
            AspekPenilaianSeeder::class,
            // Baru panggil seeder yang punya ketergantungan
            UserAndSiswaSeeder::class,
            JadwalKegiatanSeeder::class,
        ]);
    }
}
