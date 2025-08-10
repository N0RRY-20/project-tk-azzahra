{{-- Menggunakan layout admin yang sudah ada --}}
@extends('layouts.admin')

{{-- Bagian konten --}}
@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Manajemen Aspek Penilaian</h1>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl text-gray-700">Daftar Aspek Penilaian</h2>
        <a href="{{ route('admin.aspekPenilaian.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Aspek Penilaian Baru
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Aspek Penilaian</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($aspeks as $aspek)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $aspek->kategori }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $aspek->deskripsi }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.aspekPenilaian.edit', $aspek->id_aspek) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="{{ route('admin.aspekPenilaian.destroy', $aspek->id_aspek) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data Aspek Penilaian
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection