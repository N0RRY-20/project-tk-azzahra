<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Rppm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RppmController extends Controller
{
    public function index()
    {
        $rppmList = Rppm::where('id_guru', Auth::user()->guruProfil->id_guru)
            ->latest()
            ->get();
        return view('guru.rpp.index', compact('rppmList'));
    }

    public function create()
    {
        // Asumsi guru hanya wali kelas di satu kelas
        $kelas = Kelas::where('id_guru_wali', Auth::user()->guruProfil->id_guru)->first();
        return view('guru.rpp.create', ['rppm' => new Rppm(), 'kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'tahun_ajaran' => 'required|string',
            'semester' => 'required|string',
            'bulan' => 'required|string',
            'minggu_ke' => 'required|integer',
            'tema' => 'required|string',
            'sub_tema' => 'required|string',
        ]);
        $validated['id_guru'] = Auth::user()->guruProfil->id_guru;

        $rppm = Rppm::create($validated);

        return redirect()->route('guru.rppm.show', $rppm)->with('success', 'RPPM baru berhasil dibuat.');
    }

    public function show(Rppm $rppm)
    {
        // Pastikan guru hanya bisa melihat RPP miliknya
        abort_if($rppm->id_guru !== Auth::user()->guruProfil->id_guru, 403);
        $rppm->load('rpph'); // Load semua RPPH terkait
        return view('guru.rpp.show', compact('rppm'));
    }

    public function edit(Rppm $rppm)
    {
        abort_if($rppm->id_guru !== Auth::user()->guruProfil->id_guru, 403);
        $kelas = Kelas::where('id_guru_wali', Auth::user()->guruProfil->id_guru)->first();
        return view('guru.rpp.edit', compact('rppm', 'kelas'));
    }

    public function update(Request $request, Rppm $rppm)
    {
        abort_if($rppm->id_guru !== Auth::user()->guruProfil->id_guru, 403);

        $validated = $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'tahun_ajaran' => 'required|string',
            'semester' => 'required|string',
            'bulan' => 'required|string',
            'minggu_ke' => 'required|integer',
            'tema' => 'required|string',
            'sub_tema' => 'required|string',
        ]);

        $rppm->update($validated);
        return redirect()->route('guru.rppm.show', $rppm)->with('success', 'RPPM berhasil diperbarui.');
    }

    public function destroy(Rppm $rppm)
    {
        abort_if($rppm->id_guru !== Auth::user()->guruProfil->id_guru, 403);
        $rppm->delete();
        return redirect()->route('guru.rppm.index')->with('success', 'RPPM berhasil dihapus.');
    }
}
