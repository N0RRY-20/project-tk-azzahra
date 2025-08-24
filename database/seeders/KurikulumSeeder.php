<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Rppm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KurikulumSeeder extends Seeder
{
    public function run(): void
    {
        $guruProfil = \App\Models\User::where('username', 'guru1')->first()->guruProfil;
        $kelasA = Kelas::where('nama_kelas', 'Kelas A (Apel)')->first();

        if ($guruProfil && $kelasA) {
            // Membuat RPPM untuk bulan dan minggu saat ini
            Rppm::create([
                'id_guru' => $guruProfil->id_guru,
                'id_kelas' => $kelasA->id_kelas,
                'tahun_ajaran' => '2025/2026',
                'semester' => 'Ganjil',
                'bulan' => Carbon::now()->locale('id')->monthName,
                'minggu_ke' => ceil(Carbon::now()->day / 7),
                'tema' => 'Lingkunganku',
                'sub_tema' => 'Rumahku Bersih dan Sehat',
            ]);
        }
    }
}
