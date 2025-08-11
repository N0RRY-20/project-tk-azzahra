<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalKegiatan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalGrouped = JadwalKegiatan::with('kelas')
            ->orderBy('waktu_mulai')
            ->get()
            ->groupBy('hari'); // Kelompokkan berdasarkan hari

        // Urutkan hari secara manual
        $urutanHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $jadwalSorted = collect($urutanHari)->mapWithKeys(function ($hari) use ($jadwalGrouped) {
            return [$hari => $jadwalGrouped->get($hari, collect())];
        });

        return view('admin.jadwal.index', ['jadwalGrouped' => $jadwalSorted]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelasList = Kelas::all();
        return view('admin.jadwal.create', compact('kelasList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        JadwalKegiatan::create($validatedData);

        return redirect()->route('admin.jadwal-kegiatan.index')->with('success', 'Kegiatan baru berhasil ditambahkan ke jadwal.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalKegiatan $jadwalKegiatan)
    {
        $kelasList = Kelas::all();
        return view('admin.jadwal.edit', ['jadwal' => $jadwalKegiatan, 'kelasList' => $kelasList]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalKegiatan $jadwalKegiatan)
    {
        $validatedData = $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $jadwalKegiatan->update($validatedData);

        return redirect()->route('admin.jadwal-kegiatan.index')->with('success', 'Jadwal kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalKegiatan $jadwalKegiatan)
    {
        $jadwalKegiatan->delete();
        return redirect()->route('admin.jadwal-kegiatan.index')->with('success', 'Jadwal kegiatan berhasil dihapus.');
    }
}
