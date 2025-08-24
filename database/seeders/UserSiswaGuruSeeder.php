<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSiswaGuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Membuat Akun Admin & Pimpinan
            User::create(['username' => 'admin', 'password' => Hash::make('password'), 'peran' => 'admin']);
            User::create(['username' => 'pimpinan', 'password' => Hash::make('password'), 'peran' => 'pimpinan']);

            // 2. Membuat Akun Guru & Profilnya
            $guruUser = User::create(['username' => 'guru1', 'password' => Hash::make('password'), 'peran' => 'guru']);
            $guruProfil = $guruUser->guruProfil()->create(['nama_lengkap' => 'Siti Aminah, S.Pd.', 'telepon' => '081234567890']);

            // 3. Ambil Kelas A dan jadikan guru1 sebagai wali kelasnya
            $kelasA = Kelas::where('nama_kelas', 'Kelas A (Apel)')->first();
            if ($kelasA) {
                $kelasA->update(['id_guru_wali' => $guruProfil->id_guru]);
            }

            // 4. Membuat Akun Orang Tua
            $orangtuaUser = User::create(['username' => 'orangtua1', 'password' => Hash::make('password'), 'peran' => 'orangtua']);

            // 5. Membuat Siswa 1 (Budi) dan langsung hubungkan dengan Orang Tua & Kelas A
            Siswa::create([
                'nama_lengkap' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2020-01-15',
                'id_kelas' => $kelasA->id_kelas,
                'id_orangtua' => $orangtuaUser->id,
                'telepon_orangtua' => '081122223333',
                'riwayat_kesehatan' => 'Alergi debu ringan.'
            ]);

            // 6. Membuat Siswa 2 (Ani) untuk testing fitur aktivasi
            Siswa::create([
                'nama_lengkap' => 'Ani Lestari',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '2020-02-20',
                'id_kelas' => $kelasA->id_kelas,
                'id_orangtua' => null,
                'telepon_orangtua' => '08144445555',
                'kode_aktivasi' => 'AKTIVASI',
            ]);
        });
    }
}
