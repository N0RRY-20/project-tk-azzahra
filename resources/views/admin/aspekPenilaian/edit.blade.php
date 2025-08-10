@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Data Aspek Penilaian: {{ $aspekPenilaian->kategori }}</h1>
    
    <div class="bg-white p-8 rounded-lg shadow-md">
        {{-- @dd($aspek) --}}

        <form action="{{ route('admin.aspekPenilaian.update', $aspekPenilaian->id_aspek) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Aspek penilaian --}}
            <div class="mb-4">
                <label for="kategori" class="block text-gray-700 font-bold mb-2">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ old('kategori', $aspekPenilaian->kategori) }}" required>
                @error('kategori')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <input type="text" name="deskripsi" id="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ old('deskripsi', $aspekPenilaian->deskripsi) }}" required>
                @error('deskripsi')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Perbarui
                </button>
                <a href="{{ route('admin.aspekPenilaian.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection