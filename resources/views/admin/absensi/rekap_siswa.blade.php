@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Rekap Absensi Siswa</h1>

    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
        <form action="{{ route('admin.absensi.siswa') }}" method="GET">
            <div class="flex items-center space-x-4">
                <div class="w-full">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Pilih Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ $tanggalPilihan }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 invisible">Filter</label>
                    <button type="submit" class="mt-1 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Tampilkan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left ...">Nama Siswa</th>
                    <th class="px-6 py-3 text-left ...">Kelas</th>
                    <th class="px-6 py-3 text-left ...">Status</th>
                    <th class="px-6 py-3 text-left ...">Keterangan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($absensiList as $absensi)
                    <tr>
                        <td class="px-6 py-4">{{ $absensi->siswa->nama_lengkap }}</td>
                        <td class="px-6 py-4">{{ $absensi->siswa->kelas->nama_kelas }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $absensi->status == 'Hadir' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $absensi->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $absensi->keterangan ?: '-' }}</td>
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