<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiGuru;
use App\Models\AbsensiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RekapAbsensiController extends Controller
{

     /**
     * Menampilkan rekap absensi siswa.
     */
    public function rekapSiswa(Request $request)
    {
        // Ambil tanggal dari request, jika tidak ada, gunakan tanggal hari ini
        $tanggalPilihan = $request->input('tanggal', Carbon::today()->toDateString());

        // Ambil data absensi siswa pada tanggal yang dipilih
        $absensiList = AbsensiSiswa::whereDate('tanggal', $tanggalPilihan)
                                    ->with(['siswa.kelas']) // Eager loading untuk efisiensi
                                    ->get();

        return view('admin.absensi.rekap_siswa', compact('absensiList', 'tanggalPilihan'));
    }

    /**
     * Menampilkan rekap absensi guru.
     */
    public function rekapGuru(Request $request)
    {
        $tanggalPilihan = $request->input('tanggal', Carbon::today()->toDateString());

        // Ambil data absensi guru pada tanggal yang dipilih
        $absensiList = AbsensiGuru::whereDate('tanggal', $tanggalPilihan)
                                    ->with('guru') // Eager loading
                                    ->get();

        return view('admin.absensi.rekap_guru', compact('absensiList', 'tanggalPilihan'));
    }

}
