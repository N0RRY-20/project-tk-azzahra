@extends('layouts.admin') {{-- Kita bisa pakai layout admin yang sama untuk kerangka --}}

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-2">Laporan Perkembangan</h1>
        <h2 class="text-xl text-gray-700 mb-6">Siswa: {{ $siswa->nama_lengkap }}</h2>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-8">
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <h4 class="font-bold text-yellow-800">Riwayat Kesehatan Tercatat</h4>
                <p class="text-yellow-700 mt-1">{{ $siswa->riwayat_kesehatan ?: 'Tidak ada data.' }}</p>
            </div>
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                <h4 class="font-bold text-blue-800">Catatan Khusus Anda</h4>
                <p class="text-blue-700 mt-1">{{ $siswa->catatan_khusus_ortu ?: 'Tidak ada data.' }}</p>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4">
                <h3 class="text-lg font-semibold">Riwayat Laporan</h3>
            </div>
            <div class="border-t border-gray-200">
                @forelse ($siswa->laporanPerkembangan as $laporan)
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-800">{{ $laporan->aspek->kategori }}: {{ $laporan->capaian }}</p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d M Y') }}</p>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">"{{ $laporan->aspek->deskripsi }}"</p>
                        @if ($laporan->catatan_guru)
                            <div class="mt-2 p-3 bg-gray-50 rounded-md">
                                <p class="text-sm text-gray-800"><span class="font-semibold">Catatan dari
                                        {{ $laporan->guru->nama_lengkap }}:</span> {{ $laporan->catatan_guru }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">
                        Belum ada laporan perkembangan yang diinput untuk anak Anda.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- =============================================================== --}}
        {{--                BAGIAN BARU UNTUK RIWAYAT ABSENSI                 --}}
        {{-- =============================================================== --}}
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Riwayat Absensi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($siswa->absensi as $absen)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $absen->status == 'Hadir' ? 'bg-green-100 text-green-800' : ($absen->status == 'Alpa' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ $absen->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $absen->keterangan ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada data absensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

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
    </div>
@endsection
