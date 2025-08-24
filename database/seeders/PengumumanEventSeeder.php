<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Database\Seeder;

class PengumumanEventSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('peran', 'admin')->first();
        if ($admin) {
            // Buat Pengumuman Biasa
            Pengumuman::create([
                'judul' => 'Informasi Libur Sekolah',
                'isi' => 'Diberitahukan kepada seluruh orang tua/wali murid bahwa sekolah akan diliburkan pada tanggal 17 Agustus 2025.',
                'tipe' => 'Pengumuman',
                'id_pembuat' => $admin->id,
            ]);

            // Buat Event
            $event = Event::create([
                'judul' => 'Lomba Kemerdekaan TK Ceria',
                'deskripsi' => 'Ayo meriahkan hari kemerdekaan dengan mengikuti berbagai lomba seru!',
                'tanggal_event' => '2025-08-16',
            ]);

            // Buat Jenis Lomba di dalam Event
            $event->lomba()->createMany([
                ['nama_lomba' => 'Estafet Air (Bunda)', 'keterangan' => '5 Orang khusus bundanya', 'kuota' => 5],
                ['nama_lomba' => 'Tarik Tambang (Ayah/Bunda)', 'keterangan' => '10 orang, boleh ayah atau bunda', 'kuota' => 10],
            ]);
        }
    }
}
