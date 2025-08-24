@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Profil & Pengaturan Akun</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Kolom Info Profil --}}
            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-gray-900">{{ Auth::user()->username }}</h3>
                    <p class="text-sm text-gray-600">Peran: <span
                            class="font-semibold uppercase">{{ Auth::user()->peran }}</span></p>

                    @if (Auth::user()->guruProfil)
                        <div class="mt-4 border-t pt-4">
                            <p class="text-sm text-gray-500">Nama Lengkap:</p>
                            <p class="font-semibold">{{ Auth::user()->guruProfil->nama_lengkap }}</p>
                        </div>
                    @endif
                    @if (Auth::user()->siswaAsOrangtua)
                        <div class="mt-4 border-t pt-4">
                            <p class="text-sm text-gray-500">Wali dari:</p>
                            <p class="font-semibold">{{ Auth::user()->siswaAsOrangtua->nama_lengkap }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Kolom Form --}}
            <div class="md:col-span-2 space-y-6">
                <!-- FORM 1: UBAH DATA DIRI -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ubah Data Diri</h3>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('profil.update.data') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Username (untuk semua peran) --}}
                        <div class="mb-4">
                            <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                            <input type="text" name="username" id="username"
                                class="shadow border rounded w-full py-2 px-3"
                                value="{{ old('username', Auth::user()->username) }}" required>
                            @error('username')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Field tambahan khusus GURU --}}
                        @if (Auth::user()->peran === 'guru')
                            <div class="mb-4">
                                <label for="nama_lengkap" class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    class="shadow border rounded w-full py-2 px-3"
                                    value="{{ old('nama_lengkap', Auth::user()->guruProfil->nama_lengkap) }}" required>
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="telepon" class="block text-gray-700 font-bold mb-2">Telepon</label>
                                <input type="text" name="telepon" id="telepon"
                                    class="shadow border rounded w-full py-2 px-3"
                                    value="{{ old('telepon', Auth::user()->guruProfil->telepon) }}">
                                @error('telepon')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Perbarui Data
                                Diri</button>
                        </div>
                    </form>
                </div>

                <!-- FORM 2: UBAH PASSWORD -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ubah Password</h3>
                    @if (session('success_password'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            {{ session('success_password') }}
                        </div>
                    @endif
                    <form action="{{ route('profil.update.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="password_sekarang" class="block text-gray-700 font-bold mb-2">Password Saat
                                Ini</label>
                            <input type="password" name="password_sekarang" id="password_sekarang"
                                class="shadow border rounded w-full py-2 px-3" required>
                            @error('password_sekarang')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-bold mb-2">Password Baru</label>
                            <input type="password" name="password" id="password"
                                class="shadow border rounded w-full py-2 px-3" required>
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi
                                Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="shadow border rounded w-full py-2 px-3" required>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Perbarui
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
