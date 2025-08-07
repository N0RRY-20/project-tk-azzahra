<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruProfil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = GuruProfil::with('user')->latest()->get();
        return view('admin.guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'telepon' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        DB::transaction(function () use ($validatedData) {
            $user = User::create([
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'peran' => 'guru',
            ]);

            $user->guruProfil()->create([
                'nama_lengkap' => $validatedData['nama_lengkap'],
                'telepon' => $validatedData['telepon'],
            ]);
        });

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuruProfil $guru) // Route Model Binding
    {
        return view('admin.guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GuruProfil $guru)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($guru->user_id)],
            'telepon' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6', // Password opsional saat update
        ]);

        DB::transaction(function () use ($validatedData, $guru) {
            // Update data di tabel users
            $guru->user->update([
                'username' => $validatedData['username'],
            ]);
            // Jika ada password baru, update passwordnya
            if (!empty($validatedData['password'])) {
                $guru->user->update(['password' => Hash::make($validatedData['password'])]);
            }
            // Update data di tabel guru_profils
            $guru->update([
                'nama_lengkap' => $validatedData['nama_lengkap'],
                'telepon' => $validatedData['telepon'],
            ]);
        });

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuruProfil $guru)
    {
        $guru->user->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
