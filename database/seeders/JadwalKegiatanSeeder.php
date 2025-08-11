<?php

namespace Database\Seeders;

use App\Models\JadwalKegiatan;
use App\Models\Kelas;
use Illuminate\Database\Seeder;

class JadwalKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari kelas yang bernama 'Kelas A (Apel)'
        $kelasA = Kelas::where('nama_kelas', 'Kelas A (Apel)')->first();

        // Hanya jalankan jika Kelas A ditemukan
        if ($kelasA) {
            $jadwalSenin = [
                ['waktu_mulai' => '08:00', 'waktu_selesai' => '08:15', 'kegiatan' => 'Penyambutan & Doa Pagi', 'keterangan' => 'Anak masuk, salam, doa, menyimpan tas'],
                ['waktu_mulai' => '08:15', 'waktu_selesai' => '08:30', 'kegiatan' => 'Senam Pagi / Olahraga Ringan', 'keterangan' => 'Motorik kasar'],
                ['waktu_mulai' => '08:30', 'waktu_selesai' => '09:00', 'kegiatan' => 'Belajar Tematik', 'keterangan' => 'Tema hari itu (misal: “Binatang”)'],
                ['waktu_mulai' => '09:00', 'waktu_selesai' => '09:15', 'kegiatan' => 'Makan Bersama', 'keterangan' => 'Melatih sopan santun & kebersihan'],
                ['waktu_mulai' => '09:15', 'waktu_selesai' => '09:45', 'kegiatan' => 'Aktivitas Kreatif', 'keterangan' => 'Menggambar, mewarnai, membuat prakarya'],
                ['waktu_mulai' => '09:45', 'waktu_selesai' => '10:15', 'kegiatan' => 'Bermain Peran / Bermain Bebas', 'keterangan' => 'Motorik halus & sosial emosional'],
                ['waktu_mulai' => '10:15', 'waktu_selesai' => '10:45', 'kegiatan' => 'Cerita / Membaca Buku', 'keterangan' => 'Pengembangan bahasa'],
                ['waktu_mulai' => '10:45', 'waktu_selesai' => '11:15', 'kegiatan' => 'Permainan Kelompok', 'keterangan' => 'Kerja sama, kognitif'],
                ['waktu_mulai' => '11:15', 'waktu_selesai' => '11:45', 'kegiatan' => 'Review & Refleksi', 'keterangan' => 'Tanya jawab ringan kegiatan hari ini'],
                ['waktu_mulai' => '11:45', 'waktu_selesai' => '12:00', 'kegiatan' => 'Persiapan Pulang & Doa Penutup', 'keterangan' => 'Anak dijemput orang tua'],
            ];

            // Masukkan setiap kegiatan ke database
            foreach ($jadwalSenin as $kegiatan) {
                JadwalKegiatan::create([
                    'id_kelas' => $kelasA->id_kelas,
                    'hari' => 'Senin',
                    'waktu_mulai' => $kegiatan['waktu_mulai'],
                    'waktu_selesai' => $kegiatan['waktu_selesai'],
                    'kegiatan' => $kegiatan['kegiatan'],
                    'keterangan' => $kegiatan['keterangan'],
                ]);
            }
        }
    }
}
