@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Input Absensi Guru</h1>
    
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.absensi-guru.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="id_guru" class="block text-gray-700 font-bold mb-2">Pilih Guru</label>
                <select name="id_guru" id="id_guru" class="shadow border rounded w-full py-2 px-3" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($guruList as $guru)
                        <option value="{{ $guru->id_guru }}">{{ $guru->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="tanggal" class="block text-gray-700 font-bold mb-2">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="shadow border rounded w-full py-2 px-3" value="{{ date('Y-m-d') }}" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" class="shadow border rounded w-full py-2 px-3" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Alpa">Alpa</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="keterangan" class="block text-gray-700 font-bold mb-2">Keterangan (Opsional)</label>
                <textarea name="keterangan" id="keterangan" rows="3" class="shadow border rounded w-full py-2 px-3"></textarea>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                <a href="{{ route('admin.absensi-guru.index') }}" class="text-sm text-blue-500 hover:text-blue-800">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection