@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Manajemen Jadwal Kegiatan</h1>
            <a href="{{ route('admin.jadwal-kegiatan.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Kegiatan
            </a>
        </div>

        @include('partials.success_message')

        <div class="space-y-8">
            @foreach ($jadwalGrouped as $hari => $jadwals)
                <div class="bg-white shadow-md rounded-lg">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-bold text-gray-700">{{ $hari }}</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse ($jadwals as $jadwal)
                            <div class="p-4 flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="w-24 text-gray-600 font-mono">
                                        {{ date('H:i', strtotime($jadwal->waktu_mulai)) }} -
                                        {{ date('H:i', strtotime($jadwal->waktu_selesai)) }}</div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $jadwal->kegiatan }} <span
                                                class="text-sm font-normal text-blue-500 ml-2">({{ $jadwal->kelas->nama_kelas }})</span>
                                        </p>
                                        <p class="text-sm text-gray-500">{{ $jadwal->keterangan }}</p>
                                    </div>
                                </div>
                                <div class="text-sm font-medium">
                                    <a href="{{ route('admin.jadwal-kegiatan.edit', $jadwal->id_jadwal) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                    <form action="{{ route('admin.jadwal-kegiatan.destroy', $jadwal->id_jadwal) }}"
                                        method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500">
                                Tidak ada jadwal kegiatan untuk hari ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
