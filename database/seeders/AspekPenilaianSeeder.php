<?php

namespace Database\Seeders;

use App\Models\AspekPenilaian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AspekPenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AspekPenilaian::create([
            'kategori'=> 'Sosial-Emosional',
            'deskripsi'=> 'Mau berbagi mainan dengan teman.',
        ]);
        AspekPenilaian::create([
            'kategori'=> 'Motorik Kasar',
            'deskripsi'=> 'Mampu melompat dengan dua kaki seimbang.',
        ]);
    }
}
