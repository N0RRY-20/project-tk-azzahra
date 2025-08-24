<?php

namespace App\Http\Controllers\Orangtua;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\Rppm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     // Ambil user yang login, lalu ambil data anaknya melalui relasi
    //     $siswa = Auth::user()->siswaAsOrangtua;

    //     // Jika tidak ada data siswa (seharusnya tidak mungkin terjadi), arahkan ke login
    //     if (!$siswa) {
    //         Auth::logout();
    //         return redirect('/login')->with('error', 'Data siswa tidak ditemukan.');
    //     }

    //     // Ambil semua laporan perkembangan anak tersebut
    //     $laporanList = $siswa->laporanPerkembangan()->with(['guru', 'aspek'])->latest('tanggal_laporan')->get();

    //     return view('orangtua.dashboard', compact('siswa', 'laporanList'));
    // }
    public function index()
    {
        // 1. Ambil data siswa dari user yang login
        $siswa = Auth::user()->siswaAsOrangtua;

        if (!$siswa) {
            Auth::logout();
            return redirect('/login')->with('error', 'Data siswa tidak ditemukan.');
        }

        // 2. Load semua relasi yang dibutuhkan dalam satu query efisien
        $siswa->load([
            'laporanPerkembangan' => function ($query) {
                $query->with(['guru', 'aspek'])->latest('tanggal_laporan');
            },
            'absensi' => function ($query) {
                $query->latest('tanggal');
            },
            'tagihan.pembayaran',
            'komunikasi.pengirim',
            // Ambil jadwal hari ini melalui relasi kelas
            'kelas.jadwalKegiatan' => function ($query) {
                $namaHariIni = Carbon::now()->locale('id')->dayName;
                $query->where('hari', $namaHariIni)->orderBy('waktu_mulai');
            },
            // Ambil RPPM minggu ini melalui relasi kelas
            'kelas.rppm' => function ($query) {
                $query->where('bulan', Carbon::now()->locale('id')->monthName)
                    ->where('minggu_ke', ceil(Carbon::now()->day / 7));
            }
        ]);

        // 3. Ambil pengumuman secara terpisah
        $pengumumanList = Pengumuman::latest()->take(5)->get();

        // 4. Siapkan variabel untuk dikirim ke view (ambil dari relasi yang sudah di-load)
        $jadwalHariIni = $siswa->kelas ? $siswa->kelas->jadwalKegiatan : collect();
        $rppmTerkini = $siswa->kelas ? $siswa->kelas->rppm->first() : null;

        // 5. Kirim semua data ke view
        return view('orangtua.dashboard', compact('siswa', 'jadwalHariIni', 'pengumumanList', 'rppmTerkini'));
    }
}
