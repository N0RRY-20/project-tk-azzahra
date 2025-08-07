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
        $aspekPenilaian = AspekPenilaian::with('laporanPerkembangan')->latest()->get();
        return view('admin.aspekPenilaian.index', compact('aspekPenilaian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AspekPenilaian $id)
    {
        $id->delete();
        return redirect()->route('admin.aspekPenilaian.index')->with('success', 'Data Aspek berhasil dihapus.');
    }
}
