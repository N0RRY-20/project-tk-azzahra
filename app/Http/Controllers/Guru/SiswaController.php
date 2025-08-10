<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function show(Siswa $siswa)
    {
        // Eager load relasi untuk efisiensi
        $siswa->load(['laporanPerkembangan.guru', 'laporanPerkembangan.aspek']);
        
        return view('guru.siswa.show', compact('siswa'));
    }
}
