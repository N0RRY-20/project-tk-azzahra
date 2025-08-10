<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AspekPenilaian;
use Illuminate\Http\Request;

class AspekPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aspeks = AspekPenilaian::with('laporanPerkembangan')->latest()->get();
        return view('admin.aspekPenilaian.index', compact('aspeks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.aspekPenilaian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255'

        ]);

        $aspek = AspekPenilaian::create([
            'kategori' => $validatedData['kategori'],
            'deskripsi' => $validatedData['deskripsi'],

        ]);

        return redirect()->route('admin.aspekPenilaian.index')->with('success', 'Data Aspek Penilaian berhasil ditambahkan.');
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
    public function edit(AspekPenilaian $aspekPenilaian)
    {
         return view('admin.aspekPenilaian.edit', compact('aspekPenilaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AspekPenilaian $aspekPenilaian)
    {
          $validatedData = $request->validate([
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',

        ]);

        $aspekPenilaian->update($validatedData);

        return redirect()->route('admin.aspekPenilaian.index')->with('success', 'Data Aspek Penilaian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AspekPenilaian $aspekPenilaian)
    {
        $aspekPenilaian->delete();
        return redirect()->route('admin.aspekPenilaian.index')->with('success', 'Data Aspek berhasil dihapus.');
    }
}
