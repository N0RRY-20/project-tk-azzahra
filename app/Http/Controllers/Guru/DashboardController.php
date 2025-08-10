<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Temukan ID profil guru yang sedang login
        $idGuru = Auth::user()->guruProfil->id_guru;

        // Temukan kelas yang dipegang oleh guru ini
        $kelas = Kelas::where('id_guru_wali', $idGuru)->with('siswa')->first();

        // Jika guru tidak mengajar di kelas manapun, kirim data kosong
        $siswas = $kelas ? $kelas->siswa : [];

        return view('guru.dashboard', compact('siswas', 'kelas'));
    }
}
