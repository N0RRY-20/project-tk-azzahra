<?php

namespace App\Http\Controllers\Orangtua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil user yang login, lalu ambil data anaknya melalui relasi
        $siswa = Auth::user()->siswaAsOrangtua;
        
        // Jika tidak ada data siswa (seharusnya tidak mungkin terjadi), arahkan ke login
        if (!$siswa) {
            Auth::logout();
            return redirect('/login')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        // Ambil semua laporan perkembangan anak tersebut
        $laporanList = $siswa->laporanPerkembangan()->with(['guru', 'aspek'])->latest('tanggal_laporan')->get();

        return view('orangtua.dashboard', compact('siswa', 'laporanList'));
    }
}
