@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">Riwayat Absensi</h1>
                <p class="text-gray-600">Kelas: {{ $kelas->nama_kelas }}</p>
            </div>
            <a href="{{ route('guru.absensi.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Input Absensi Hari Ini
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <form action="{{ route('guru.absensi.index') }}" method="GET">
                <div class="flex items-center space-x-4">
                    <div class="w-full">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tampilkan Absensi
                            Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ $tanggalPilihan }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 invisible">Filter</label>
                        <button type="submit"
                            class="mt-1 w-full bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">
                            Lihat
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
                        <th class="px-6 py-3 text-left ...">Status</th>
                        <th class="px-6 py-3 text-left ...">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($absensiList as $absensi)
                        <tr
                            class="{{ $absensi->status == 'Hadir' ? 'bg-green-50' : ($absensi->status == 'Alpa' ? 'bg-red-50' : 'bg-yellow-50') }}">
                            <td class="px-6 py-4">{{ $absensi->siswa->nama_lengkap }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $absensi->status == 'Hadir' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $absensi->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $absensi->keterangan ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data absensi untuk tanggal ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
