<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ATP;
use Illuminate\Http\Request;

class ATPController extends Controller
{
    /**
     * Menampilkan daftar Alur Tujuan Pembelajaran.
     */
    public function index()
    {
        // Ambil semua data ATP, urutkan, lalu kelompokkan
        // agar mudah ditampilkan di view.
        $atpGrouped = ATP::orderBy('tahun_ajaran', 'desc')
            ->orderBy('semester')
            ->orderBy('urutan')
            ->get()
            ->groupBy(['tahun_ajaran', 'semester']);

        return view('guru.atp.index', compact('atpGrouped'));
    }
}
