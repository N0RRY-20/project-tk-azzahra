@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Data Kelas: {{ $kelas->nama_kelas }}</h1>
    
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.kelas.update', $kelas->id_kelas) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Nama Kelas --}}
            <div class="mb-4">
                <label for="nama_kelas" class="block text-gray-700 font-bold mb-2">Nama kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                @error('nama_kelas')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Perbarui
                </button>
                <a href="{{ route('admin.kelas.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection