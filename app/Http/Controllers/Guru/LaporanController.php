<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\AspekPenilaian;
use App\Models\LaporanPerkembangan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function edit(LaporanPerkembangan $laporan)
    {
        // Pastikan guru yang login adalah pemilik laporan ini
        if ($laporan->id_guru !== Auth::user()->guruProfil->id_guru) {
            abort(403, 'Anda tidak punya hak untuk mengedit laporan ini.');
        }

        $aspekList = AspekPenilaian::all();
        $siswa = $laporan->siswa; // Ambil data siswa dari laporan
        return view('guru.laporan.edit', compact('laporan', 'siswa', 'aspekList'));
    }

    // create
      public function create(Siswa $siswa)
    {
        $aspekList = AspekPenilaian::all();
        return view('guru.laporan.create', compact('siswa', 'aspekList'));
    }
     public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_aspek' => 'required|exists:aspek_penilaian,id_aspek',
            'capaian' => 'required|string',
            'catatan_guru' => 'nullable|string',
            'tanggal_laporan' => 'required|date',
        ]);

        // Ambil id_guru dari user yang sedang login
        $validatedData['id_guru'] = Auth::user()->guruProfil->id_guru;

        LaporanPerkembangan::create($validatedData);

        return redirect()->route('guru.dashboard')->with('success', 'Laporan perkembangan berhasil disimpan.');
    }
    public function update(Request $request, LaporanPerkembangan $laporan)
    {
        // Otorisasi
        if ($laporan->id_guru !== Auth::user()->guruProfil->id_guru) {
            abort(403);
        }

        $validatedData = $request->validate([
            'id_aspek' => 'required|exists:aspek_penilaian,id_aspek',
            'capaian' => 'required|string',
            'catatan_guru' => 'nullable|string',
            'tanggal_laporan' => 'required|date',
        ]);
        
        $laporan->update($validatedData);

        return redirect()->route('guru.siswa.show', $laporan->id_siswa)->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Menghapus laporan dari database.
     */
    public function destroy(LaporanPerkembangan $laporan)
    {
        // Otorisasi
        if ($laporan->id_guru !== Auth::user()->guruProfil->id_guru) {
            abort(403);
        }

        $id_siswa = $laporan->id_siswa; // Simpan id siswa sebelum dihapus
        $laporan->delete();

        return redirect()->route('guru.siswa.show', $id_siswa)->with('success', 'Laporan berhasil dihapus.');
    }
}
