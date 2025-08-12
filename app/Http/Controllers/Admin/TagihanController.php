<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanList = Tagihan::with('siswa.kelas')->latest()->get();
        return view('admin.keuangan.tagihan.index', compact('tagihanList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua siswa untuk ditampilkan di dropdown
        $siswaList = Siswa::orderBy('nama_lengkap')->get();
        return view('admin.keuangan.tagihan.create', compact('siswaList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'deskripsi' => 'required|string|max:255',
            'jumlah_tagihan' => 'required|integer|min:0',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        Tagihan::create($validatedData);
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan baru berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan)
    {
        // Eager load relasi siswa dan pembayaran
        $tagihan->load(['siswa', 'pembayaran.admin']);
        return view('admin.keuangan.tagihan.show', compact('tagihan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        // Ambil semua siswa untuk ditampilkan di dropdown
        $siswaList = Siswa::orderBy('nama_lengkap')->get();
        return view('admin.keuangan.tagihan.edit', compact('tagihan', 'siswaList'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'deskripsi' => 'required|string|max:255',
            'jumlah_tagihan' => 'required|integer|min:0',
            'tanggal_jatuh_tempo' => 'required|date',
            // Tambahkan validasi untuk status jika diperlukan
            'status' => 'required|string|in:Belum Lunas,Sebagian,Lunas',
        ]);

        $tagihan->update($validatedData);
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tagihan $tagihan)
    {
        // Logika delete...
        $tagihan->delete();
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil dihapus.');
    }
}
