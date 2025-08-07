<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AspekPenilaian extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('aspek_penilaian')->insert([
        'kategori'=> 'moral',
        'deskripsi'=> 'bagus dan baik',
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
        ]);
    }
}