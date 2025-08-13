<?php

namespace App\Http\Controllers\Orangtua;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
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
        // Ambil user yang login, lalu ambil data anaknya melalui relasi
        $siswa = Auth::user()->siswaAsOrangtua;

        if (!$siswa) {
            Auth::logout();
            return redirect('/login')->with('error', 'Data siswa tidak ditemukan.');
        }

        $jadwalHariIni = collect();
        if ($siswa->kelas) {
            $namaHariIni = Carbon::now()->locale('id')->dayName;
            $jadwalHariIni = $siswa->kelas->jadwalKegiatan()
                ->where('hari', $namaHariIni)
                ->orderBy('waktu_mulai')
                ->get();
        }
        // Load semua relasi yang dibutuhkan untuk ditampilkan di view
        // Ini cara efisien untuk mengambil laporan dan absensi sekaligus
        $siswa->load([
            'laporanPerkembangan' => function ($query) {
                $query->with(['guru', 'aspek'])->latest('tanggal_laporan');
            },
            'absensi' => function ($query) {
                $query->latest('tanggal');
            },
            'komunikasi.pengirim',
            'tagihan.pembayaran'
        ]);
        $pengumumanList = Pengumuman::latest()->take(5)->get();
        return view('orangtua.dashboard', compact('siswa', 'jadwalHariIni', 'pengumumanList'));
    }
}
