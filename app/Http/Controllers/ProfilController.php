<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman pengaturan profil.
     */
    public function edit()
    {
        return view('profil.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Memperbarui password pengguna.
     */
    /**
     * Memperbarui data diri pengguna (username, nama, telepon).
     */
    public function updateData(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi dasar untuk username
        $request->validate([
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
        ]);

        // Update username di tabel users
        $user->update(['username' => $request->username]);

        // Logika tambahan jika pengguna adalah GURU
        if ($user->peran === 'guru') {
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'telepon' => 'nullable|string|max:20',
            ]);
            $user->guruProfil()->update([
                'nama_lengkap' => $request->nama_lengkap,
                'telepon' => $request->telepon,
            ]);
        }

        return back()->with('success', 'Data diri berhasil diperbarui.');
    }

    /**
     * Memperbarui password pengguna.
     */
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'password_sekarang' => ['required', 'current_password'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success_password', 'Password berhasil diperbarui.');
    }
}
