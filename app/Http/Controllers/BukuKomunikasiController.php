<?php

namespace App\Http\Controllers;

use App\Models\BukuKomunikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuKomunikasiController extends Controller
{
    /**
     * Menyimpan pesan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'pesan' => 'required|string',
        ]);

        // 2. Tambahkan ID pengirim dari user yang sedang login
        $validatedData['id_pengirim'] = Auth::id();

        // 3. Simpan pesan ke database
        BukuKomunikasi::create($validatedData);

        // 4. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
