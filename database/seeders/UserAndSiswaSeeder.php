<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\GuruProfil;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAndSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Membuat Akun Admin
            User::create([
                'username' => 'admin',
                'password' => Hash::make('password'),
                'peran' => 'admin',
            ]);

            // 2. Membuat Akun Guru beserta Profilnya
            $guruUser = User::create([
                'username' => 'guru1',
                'password' => Hash::make('password'),
                'peran' => 'guru',
            ]);
            $guruProfil = $guruUser->guruProfil()->create([
                'nama_lengkap' => 'Siti Aminah, S.Pd.',
                'telepon' => '081234567890'
            ]);

            // 3. Ambil Kelas A dan jadikan guru1 sebagai wali kelasnya
            $kelasA = Kelas::where('nama_kelas', 'Kelas A (Apel)')->first();
            if ($kelasA) {
                $kelasA->update(['id_guru_wali' => $guruProfil->id_guru]);
            }

            // 4. Membuat Akun Orang Tua
            $orangtuaUser = User::create([
                'username' => 'orangtua1',
                'password' => Hash::make('password'),
                'peran' => 'orangtua',
            ]);
            
            // 5. Membuat Siswa 1 dan langsung hubungkan dengan Orang Tua & Kelas A
            Siswa::create([
                'nama_lengkap' => 'Budi Santoso',
                'tanggal_lahir' => '2020-01-15',
                'id_kelas' => $kelasA->id_kelas,
                'id_orangtua' => $orangtuaUser->id,
                'telepon_orangtua' => '081122223333',
            ]);

            // 6. Membuat Siswa 2 (tanpa orang tua) untuk testing fitur aktivasi
            Siswa::create([
                'nama_lengkap' => 'Ani Lestari',
                'tanggal_lahir' => '2020-02-20',
                'id_kelas' => $kelasA->id_kelas,
                'id_orangtua' => null, // Dibiarkan kosong
                'telepon_orangtua' => '08144445555',
                'kode_aktivasi' => strtoupper(Str::random(8)),
            ]);
        });
    
    }
}
