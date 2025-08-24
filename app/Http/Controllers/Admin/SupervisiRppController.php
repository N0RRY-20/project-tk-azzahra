<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruProfil;
use Illuminate\Http\Request;

class SupervisiRppController extends Controller
{
    /**
     * Menampilkan daftar semua guru untuk dipilih.
     */
    public function index()
    {
        $guruList = GuruProfil::with('user')->get();
        return view('admin.supervisi.index', compact('guruList'));
    }

    /**
     * Menampilkan semua RPP milik seorang guru.
     */
    public function show(GuruProfil $guru)
    {
        // Eager load semua RPPM beserta RPPH di dalamnya
        $guru->load(['rppm' => function ($query) {
            $query->latest()->with('rpph');
        }]);

        return view('admin.supervisi.show', compact('guru'));
    }
}
