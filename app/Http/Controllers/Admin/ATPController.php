<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ATP;
use Illuminate\Http\Request;

class ATPController extends Controller
{
    public function index()
    {
        $atpList = ATP::orderBy('urutan')->get();
        return view('admin.atp.index', compact('atpList'));
    }

    public function create()
    {
        return view('admin.atp.create', ['atp' => new ATP()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'fase_perkembangan' => 'required|string|max:255',
            'elemen_kurikulum' => 'required|string|max:255',
            'tujuan_pembelajaran' => 'required|string',
            'urutan' => 'nullable|integer',
        ]);

        ATP::create($validated);
        return redirect()->route('admin.atp.index')->with('success', 'Tujuan Pembelajaran baru berhasil ditambahkan.');
    }

    public function edit(ATP $atp)
    {
        return view('admin.atp.edit', compact('atp'));
    }

    public function update(Request $request, ATP $atp)
    {
        $validated = $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'fase_perkembangan' => 'required|string|max:255',
            'elemen_kurikulum' => 'required|string|max:255',
            'tujuan_pembelajaran' => 'required|string',
            'urutan' => 'nullable|integer',
        ]);

        $atp->update($validated);
        return redirect()->route('admin.atp.index')->with('success', 'Tujuan Pembelajaran berhasil diperbarui.');
    }

    public function destroy(ATP $atp)
    {
        $atp->delete();
        return redirect()->route('admin.atp.index')->with('success', 'Tujuan Pembelajaran berhasil dihapus.');
    }
}
