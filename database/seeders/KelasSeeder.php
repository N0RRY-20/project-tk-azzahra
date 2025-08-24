<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::create(['nama_kelas' => 'Kelas A (Apel)']);
        Kelas::create(['nama_kelas' => 'Kelas B (Belimbing)']);
    }
}
