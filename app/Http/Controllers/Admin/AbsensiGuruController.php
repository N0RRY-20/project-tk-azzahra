<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiGuru;
use App\Models\GuruProfil;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AbsensiGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggalPilihan = $request->input('tanggal', Carbon::today()->toDateString());

        $absensiList = AbsensiGuru::whereDate('tanggal', $tanggalPilihan)
                                    ->with('guru')
                                    ->get();

        return view('admin.absensi-guru.index', compact('absensiList', 'tanggalPilihan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guruList = GuruProfil::all();
        return view('admin.absensi-guru.create', compact('guruList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_guru' => 'required|exists:guru_profils,id_guru',
            'tanggal' => 'required|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);
        
        // Gunakan updateOrCreate untuk mencegah duplikasi
        AbsensiGuru::updateOrCreate(
            ['id_guru' => $validatedData['id_guru'], 'tanggal' => $validatedData['tanggal']],
            ['status' => $validatedData['status'], 'keterangan' => $validatedData['keterangan']]
        );

        return redirect()->route('admin.absensi-guru.index', ['tanggal' => $validatedData['tanggal']])
                         ->with('success', 'Absensi guru berhasil disimpan.');
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
    public function edit(AbsensiGuru $absensiGuru)
    {
        $guruList = GuruProfil::all();
        return view('admin.absensi-guru.edit', compact('absensiGuru', 'guruList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AbsensiGuru $absensiGuru)
    {
        $validatedData = $request->validate([
            'id_guru' => 'required|exists:guru_profils,id_guru',
            'tanggal' => 'required|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);
        
        $absensiGuru->update($validatedData);

        return redirect()->route('admin.absensi-guru.index', ['tanggal' => $validatedData['tanggal']])
                         ->with('success', 'Absensi guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AbsensiGuru $absensiGuru)
    {
        $tanggal = $absensiGuru->tanggal;
        $absensiGuru->delete();
        
        return redirect()->route('admin.absensi-guru.index', ['tanggal' => $tanggal])
                         ->with('success', 'Absensi guru berhasil dihapus.');
    }
}
