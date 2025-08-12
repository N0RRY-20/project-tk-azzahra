@extends('layouts.admin') {{-- Kita bisa pakai layout admin yang sama --}}

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">
            Dashboard Guru - {{ $kelas->nama_kelas ?? 'Anda belum menjadi wali kelas' }}
        </h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- =============================================================== --}}
        {{--              BAGIAN BARU UNTUK PENGUMUMAN & EVENT                --}}
        {{-- =============================================================== --}}
        <div class="mb-8">
            <h2 class="text-xl text-gray-700 mb-4">Pengumuman & Event Terbaru</h2>
            <div class="space-y-4">
                @forelse ($pengumumanList as $item)
                    <div
                        class="bg-white shadow-md rounded-lg p-4 border-l-4 {{ $item->tipe == 'Event' ? 'border-indigo-500' : 'border-green-500' }}">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-bold text-gray-800">{{ $item->judul }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->isi, 150) }}</p>
                            </div>
                            <span
                                class="text-xs font-semibold px-2 py-1 rounded-full {{ $item->tipe == 'Event' ? 'bg-indigo-100 text-indigo-800' : 'bg-green-100 text-green-800' }}">
                                {{ $item->tipe }}
                            </span>
                        </div>
                        @if ($item->tipe == 'Event' && $item->tanggal_event)
                            <p class="text-sm font-semibold text-indigo-700 mt-2">Tanggal Event:
                                {{ \Carbon\Carbon::parse($item->tanggal_event)->format('d M Y') }}</p>
                        @endif
                    </div>
                @empty
                    <div class="bg-white shadow-md rounded-lg p-4 text-center text-gray-500">
                        Tidak ada pengumuman atau event terbaru.
                    </div>
                @endforelse
            </div>
        </div>


        {{-- =============================================================== --}}
        {{--                BAGIAN BARU UNTUK JADWAL HARI INI                 --}}
        {{-- =============================================================== --}}
        <div class="bg-white shadow-md rounded-lg mb-8">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Jadwal Kegiatan Hari Ini
                    ({{ \Carbon\Carbon::now()->locale('id')->dayName }})</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse ($jadwalHariIni as $jadwal)
                    <div class="p-4 flex items-center">
                        <div class="w-24 text-gray-600 font-mono">{{ date('H:i', strtotime($jadwal->waktu_mulai)) }}</div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $jadwal->kegiatan }}</p>
                            <p class="text-sm text-gray-500">{{ $jadwal->keterangan }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">
                        Tidak ada jadwal kegiatan untuk hari ini.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Bagian Daftar Siswa (Tetap Sama) --}}
        <h2 class="text-xl text-gray-700 mb-4">Daftar Siswa</h2>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Siswa</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($siswas as $siswa)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('guru.siswa.show', $siswa->id_siswa) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $siswa->nama_lengkap }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('guru.laporan.create', $siswa->id_siswa) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    + Tambah Laporan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada siswa di kelas Anda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
