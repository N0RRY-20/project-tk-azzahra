<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruProfil;
use App\Models\LaporanPerkembangan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil Jumlah Siswa Aktif
        // $jumlahSiswa = Siswa::count();
        $jumlahSiswaLaki = Siswa::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahSiswaPerempuan = Siswa::where('jenis_kelamin', 'Perempuan')->count();


        // 2. Mengambil Jumlah Guru
        $jumlahGuru = GuruProfil::count();

        // 3. Mengambil Laporan Perkembangan Masuk Hari Ini
        $laporanHariIni = LaporanPerkembangan::whereDate('tanggal_laporan', Carbon::today())->count();

        // 4. Mengambil Guru yang Hadir Hari Ini (Contoh, jika tabel absensi ada)
        // Jika belum ada tabel absensi, Anda bisa beri nilai 0 atau sembunyikan kartu ini
        // $guruHadirHariIni = AbsensiGuru::whereDate('tanggal', Carbon::today())->where('status', 'Hadir')->count();
        $guruHadirHariIni = 0; // Ganti dengan logika di atas jika sudah ada

        // 5. Kirim semua data ke view
        return view('admin.dashboard', [
            // 'jumlahSiswa' => $jumlahSiswa,
            'jumlahSiswaLaki' => $jumlahSiswaLaki,
            'jumlahSiswaPerempuan' => $jumlahSiswaPerempuan,
            'jumlahGuru' => $jumlahGuru,
            'laporanHariIni' => $laporanHariIni,
            'guruHadirHariIni' => $guruHadirHariIni,
        ]);
    }
}
