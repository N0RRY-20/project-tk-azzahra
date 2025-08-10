<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ActivationController extends Controller
{
    public function create()
    {
        return view('auth.aktivasi');
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_aktivasi' => 'required|string|exists:siswa,kode_aktivasi',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        // Cari siswa berdasarkan kode aktivasi
        $siswa = Siswa::where('kode_aktivasi', $request->kode_aktivasi)->first();

        // Cek apakah akun untuk siswa ini sudah pernah diaktivasi
        if ($siswa->id_orangtua) {
            return back()->with('error', 'Akun untuk siswa ini sudah diaktivasi.');
        }

        // Buat user baru dan hubungkan ke data siswa
        $user = DB::transaction(function () use ($request, $siswa) {
            $newUser = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'peran' => 'orangtua',
            ]);

            $siswa->update([
                'id_orangtua' => $newUser->id,
                'kode_aktivasi' => null, // Hapus kode agar tidak bisa dipakai lagi
            ]);

            return $newUser;
        });
        
        // Login-kan user yang baru dibuat
        Auth::login($user);
        $request->session()->regenerate();

        // Arahkan ke dashboard orang tua
        return redirect()->route('orangtua.dashboard');
    }
}
