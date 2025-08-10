<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruProfil;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelass = Kelas::with('waliKelas')->get();
        return view('admin.kelas.index', compact('kelass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $guruList = GuruProfil::all();
        return view('admin.kelas.create',compact('guruList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'nama_kelas' => 'required|string|unique:kelas,nama_kelas',
            'id_guru_wali' => 'nullable|exists:guru_profils,id_guru'

        ]);

        Kelas::create($validatedData);

        return redirect()->route('admin.kelas.index')->with('success', 'Data Kelas berhasil ditambahkan.');
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
    public function edit(Kelas $kelas)
    {
         $guruList = GuruProfil::all();
        return view('admin.kelas.edit', compact('kelas','guruList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
         $validatedData = $request->validate([
            'nama_kelas' => ['required', 'string', Rule::unique('kelas')->ignore($kelas->id_kelas,'id_kelas')],
            'id_guru_wali' => 'nullable|exists:guru_profils,id_guru' // <-- VALIDASI BARU
        ]);

        $kelas->update($validatedData);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
