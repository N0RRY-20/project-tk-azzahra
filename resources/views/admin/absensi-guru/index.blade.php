@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Manajemen Absensi Guru</h1>

    <div class="flex justify-between items-center mb-6">
        <form action="{{ route('admin.absensi-guru.index') }}" method="GET" class="flex items-center space-x-4">
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tampilkan Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ $tanggalPilihan }}" class="mt-1 rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 invisible">Filter</label>
                <button type="submit" class="mt-1 bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">Lihat</button>
            </div>
        </form>
        <a href="{{ route('admin.absensi-guru.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Input Absensi
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left ...">Nama Guru</th>
                    <th class="px-6 py-3 text-left ...">Status</th>
                    <th class="px-6 py-3 text-left ...">Keterangan</th>
                    <th class="px-6 py-3 text-right ...">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($absensiList as $absensi)
                    <tr>
                        <td class="px-6 py-4">{{ $absensi->guru->nama_lengkap }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $absensi->status == 'Hadir' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $absensi->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $absensi->keterangan ?: '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.absensi-guru.edit', $absensi) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="{{ route('admin.absensi-guru.destroy', $absensi) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data absensi untuk tanggal ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection