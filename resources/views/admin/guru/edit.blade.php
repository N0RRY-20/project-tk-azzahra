@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Data Guru: {{ $guru->nama_lengkap }}</h1>
    
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.guru.update', $guru->id_guru) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Nama Lengkap --}}
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ old('nama_lengkap', $guru->nama_lengkap) }}" required>
                @error('nama_lengkap')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>
            
            {{-- Username --}}
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                <input type="text" name="username" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ old('username', $guru->user->username) }}" required>
                @error('username')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- Telepon --}}
            <div class="mb-4">
                <label for="telepon" class="block text-gray-700 font-bold mb-2">Telepon (Opsional)</label>
                <input type="text" name="telepon" id="telepon" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ old('telepon', $guru->telepon) }}">
                @error('telepon')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password Baru (Opsional)</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                <p class="text-gray-600 text-xs italic mt-2">Kosongkan jika tidak ingin mengubah password.</p>
                @error('password')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Perbarui
                </button>
                <a href="{{ route('admin.guru.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection