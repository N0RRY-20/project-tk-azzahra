<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPerkembangan;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    public function create()
    {
        $siswaList = Siswa::orderBy('nama_lengkap')->get();
        return view('admin.raport.create', compact('siswaList'));
    }

    /**
     * Mengumpulkan data dan men-generate PDF.
     */
    public function cetak(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // 2. Ambil data yang dibutuhkan
        $siswa = Siswa::find($validated['id_siswa']);
        $laporanList = LaporanPerkembangan::where('id_siswa', $validated['id_siswa'])
            ->whereBetween('tanggal_laporan', [$validated['tanggal_mulai'], $validated['tanggal_akhir']])
            ->with('aspek')
            ->orderBy('tanggal_laporan')
            ->get();

        // 3. Kelompokkan laporan berdasarkan kategori aspek
        $laporanGrouped = $laporanList->groupBy('aspek.kategori');

        // 4. Buat PDF dari view
        $pdf = Pdf::loadView('admin.raport.template', [
            'siswa' => $siswa,
            'laporanGrouped' => $laporanGrouped,
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_akhir' => $validated['tanggal_akhir'],
        ]);

        // 5. Tampilkan PDF di browser
        return $pdf->stream('raport-' . $siswa->nama_lengkap . '.pdf');
    }
}
