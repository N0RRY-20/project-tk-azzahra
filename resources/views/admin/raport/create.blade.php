@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Generate Raport Siswa</h1>

    <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
        <form action="{{ route('admin.raport.cetak') }}" method="POST" target="_blank">
            @csrf
            
            <div class="mb-4">
                <label for="id_siswa" class="block text-gray-700 font-bold mb-2">Pilih Siswa</label>
                <select name="id_siswa" id="id_siswa" class="shadow border rounded w-full py-2 px-3" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswaList as $siswa)
                        <option value="{{ $siswa->id_siswa }}">{{ $siswa->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="tanggal_mulai" class="block text-gray-700 font-bold mb-2">Dari Tanggal</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="shadow border rounded w-full py-2 px-3" required>
                </div>

                <div class="mb-4">
                    <label for="tanggal_akhir" class="block text-gray-700 font-bold mb-2">Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="shadow border rounded w-full py-2 px-3" required>
                </div>
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Cetak Raport
                </button>
            </div>
        </form>
    </div>
</div>
@endsection