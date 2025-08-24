<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Rppm;
use App\Models\Rpph;
use Illuminate\Http\Request;

class RpphController extends Controller
{
    public function create(Rppm $rppm)
    {
        return view('guru.rpp.rpph.create', ['rppm' => $rppm, 'rpph' => new Rpph()]);
    }

    public function store(Request $request, Rppm $rppm)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kegiatan_pembuka' => 'nullable|string',
            'kegiatan_inti' => 'nullable|string',
            'kegiatan_penutup' => 'nullable|string',
            'alat_dan_bahan' => 'nullable|string',
        ]);

        $rppm->rpph()->create($validated);

        return redirect()->route('guru.rppm.show', $rppm)->with('success', 'RPPH baru berhasil ditambahkan.');
    }

    public function edit(Rpph $rpph)
    {
        return view('guru.rpp.rpph.edit', compact('rpph'));
    }

    public function update(Request $request, Rpph $rpph)
    {
        $validated = $request->validate([/* ... validasi sama seperti store ... */]);
        $rpph->update($validated);
        return redirect()->route('guru.rppm.show', $rpph->id_rppm)->with('success', 'RPPH berhasil diperbarui.');
    }

    public function destroy(Rpph $rpph)
    {
        $id_rppm = $rpph->id_rppm;
        $rpph->delete();
        return redirect()->route('guru.rppm.show', $id_rppm)->with('success', 'RPPH berhasil dihapus.');
    }
}
