<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\AbsensiSiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    /**
     * Menampilkan riwayat absensi kelas. 
     */
    public function index(Request $request)
    {
        $idGuru = Auth::user()->guruProfil->id_guru;
        $kelas = Kelas::where('id_guru_wali', $idGuru)->firstOrFail(); // Pastikan guru punya kelas

        $tanggalPilihan = $request->input('tanggal', Carbon::today()->toDateString());

        $absensiList = AbsensiSiswa::whereIn('id_siswa', $kelas->siswa->pluck('id_siswa'))
            ->whereDate('tanggal', $tanggalPilihan)
            ->with('siswa')
            ->get();

        return view('guru.absensi.index', compact('kelas', 'absensiList', 'tanggalPilihan'));
    }

    public function create()
    {
        $idGuru = Auth::user()->guruProfil->id_guru;
        $kelas = Kelas::where('id_guru_wali', $idGuru)->with('siswa')->first();

        // Ambil data absensi yang sudah ada untuk hari ini
        $absensiHariIni = AbsensiSiswa::whereIn('id_siswa', $kelas->siswa->pluck('id_siswa'))
            ->whereDate('tanggal', Carbon::today())
            ->get()
            ->keyBy('id_siswa');

        return view('guru.absensi.create', compact('kelas', 'absensiHariIni'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'absensi' => 'required|array',
            'absensi.*.status' => 'required|string|in:Hadir,Terlambat,Izin,Sakit,Alpa',
            'absensi.*.keterangan' => 'nullable|string',
            'absensi.*.waktu_hadir' => 'nullable|date_format:H:i',
        ]);

        $tanggal = Carbon::today();

        foreach ($request->absensi as $id_siswa => $data) {
            AbsensiSiswa::updateOrCreate(
                [
                    'id_siswa' => $id_siswa,
                    'tanggal'  => $tanggal,
                ],
                [
                    'status' => $data['status'],
                    'waktu_hadir' => ($data['status'] == 'Hadir' || $data['status'] == 'Terlambat') ? ($data['waktu_hadir'] ?? null) : null,
                    'keterangan' => $data['keterangan'] ?? null,
                ]
            );
        }

        return redirect()->route('guru.absensi.index')->with('success', 'Absensi hari ini berhasil disimpan.');
    }
}
