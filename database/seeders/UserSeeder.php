<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin1',
            'password' => Hash::make('longfire'),
            'peran' => 'admin',
        ]);

        $guru = User::create([
            'username' => 'guru1',
            'password' => Hash::make('longfire'),
            'peran' => 'guru',
        ]);
        $guru->guruProfil()->create([
            'nama_lengkap' => 'guru1saya',
            'telepon' => '081234567890'
        ]);
        Kelas::create([
            'nama_kelas' => 'jelas_A'
        ]);
    }
}
