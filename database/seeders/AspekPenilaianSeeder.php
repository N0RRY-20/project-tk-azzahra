<?php

namespace Database\Seeders;

use App\Models\AspekPenilaian;
use Illuminate\Database\Seeder;

class AspekPenilaianSeeder extends Seeder
{
    public function run(): void
    {
        AspekPenilaian::create(['kategori' => 'Sosial-Emosional', 'deskripsi' => 'Mau berbagi mainan dengan teman.']);
        AspekPenilaian::create(['kategori' => 'Motorik Kasar', 'deskripsi' => 'Mampu melompat dengan dua kaki seimbang.']);
        AspekPenilaian::create(['kategori' => 'Kognitif', 'deskripsi' => 'Mengenal konsep besar dan kecil.']);
    }
}
