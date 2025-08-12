@extends('layouts.admin') {{-- Menggunakan layout admin yang sama untuk kerangka --}}

@section('content')
    <div class="p-6" x-data="{ activeTab: 'laporan' }">
        <h1 class="text-3xl font-semibold text-gray-800 mb-2">Dashboard Orang Tua</h1>
        <h2 class="text-xl text-gray-700 mb-6">Siswa: {{ $siswa->nama_lengkap }}</h2>

        {{-- =============================================================== --}}
        {{--            INFORMASI YANG SELALU TAMPIL (STATIS)                --}}
        {{-- =============================================================== --}}

        {{-- Pengumuman --}}
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Pengumuman & Event Terbaru</h3>
            <div class="space-y-3">
                @forelse ($pengumumanList as $item)
                    <div
                        class="bg-white shadow-md rounded-lg p-3 border-l-4 {{ $item->tipe == 'Event' ? 'border-indigo-500' : 'border-green-500' }}">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-bold text-gray-800">{{ $item->judul }}</p>
                                @if ($item->tipe == 'Event' && $item->tanggal_event)
                                    <p class="text-xs font-semibold text-indigo-700">Tanggal Event:
                                        {{ \Carbon\Carbon::parse($item->tanggal_event)->format('d M Y') }}</p>
                                @endif
                            </div>
                            <span
                                class="text-xs font-semibold px-2 py-1 rounded-full {{ $item->tipe == 'Event' ? 'bg-indigo-100 text-indigo-800' : 'bg-green-100 text-green-800' }}">{{ $item->tipe }}</span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white shadow-md rounded-lg p-4 text-center text-gray-500">Tidak ada pengumuman.</div>
                @endforelse
            </div>
        </div>

        {{-- Info Kesehatan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-8">
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                <h4 class="font-bold text-yellow-800">Riwayat Kesehatan Tercatat</h4>
                <p class="text-yellow-700 mt-1">{{ $siswa->riwayat_kesehatan ?: 'Tidak ada data.' }}</p>
            </div>
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                <h4 class="font-bold text-blue-800">Catatan Khusus Anda</h4>
                <p class="text-blue-700 mt-1">{{ $siswa->catatan_khusus_ortu ?: 'Tidak ada data.' }}</p>
            </div>
        </div>

        {{-- =============================================================== --}}
        {{--                   ANTARMUKA TAB INTERAKTIF                      --}}
        {{-- =============================================================== --}}
        <div class="bg-white shadow-md rounded-lg">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-6 px-6">
                    <a href="#" @click.prevent="activeTab = 'laporan'"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'laporan', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'laporan' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Laporan Perkembangan</a>
                    <a href="#" @click.prevent="activeTab = 'absensi'"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'absensi', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'absensi' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Riwayat Absensi</a>
                    <a href="#" @click.prevent="activeTab = 'keuangan'"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'keuangan', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'keuangan' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Info Keuangan</a>
                    <a href="#" @click.prevent="activeTab = 'komunikasi'"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'komunikasi', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'komunikasi' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Buku Komunikasi</a>
                </nav>
            </div>

            <div>
                {{-- KONTEN TAB 1: LAPORAN PERKEMBANGAN --}}
                <div x-show="activeTab === 'laporan'" class="divide-y divide-gray-200">
                    @forelse ($siswa->laporanPerkembangan as $laporan)
                        <div class="p-4">
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-800">{{ $laporan->aspek->kategori }}: {{ $laporan->capaian }}
                                </p>
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
                        <div class="p-4 text-center text-gray-500">Belum ada laporan perkembangan.</div>
                    @endforelse
                </div>

                {{-- KONTEN TAB 2: RIWAYAT ABSENSI --}}
                <div x-show="activeTab === 'absensi'" class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left ...">Tanggal</th>
                                <th class="px-6 py-3 text-left ...">Status</th>
                                <th class="px-6 py-3 text-left ...">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($siswa->absensi as $absen)
                                <tr>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{-- ... logika badge warna ... --}}
                                    </td>
                                    <td class="px-6 py-4">{{ $absen->keterangan ?: '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada data absensi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- KONTEN TAB 3: INFO KEUANGAN --}}
                <div x-show="activeTab === 'keuangan'" class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left ...">Deskripsi</th>
                                <th class="px-6 py-3 text-left ...">Jumlah</th>
                                <th class="px-6 py-3 text-left ...">Jatuh Tempo</th>
                                <th class="px-6 py-3 text-left ...">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($siswa->tagihan as $tagihan)
                                <tr>
                                    <td class="px-6 py-4">{{ $tagihan->deskripsi }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($tagihan->tanggal_jatuh_tempo)->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        {{-- ... logika badge warna ... --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada tagihan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- KONTEN TAB 4: BUKU KOMUNIKASI --}}
                <div x-show="activeTab === 'komunikasi'">
                    <div class="p-4 h-96 overflow-y-auto space-y-4">
                        @forelse ($siswa->komunikasi as $pesan)
                            <div class="flex {{ $pesan->pengirim->id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                                <div
                                    class="max-w-xs md:max-w-md p-3 rounded-lg {{ $pesan->pengirim->id === Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                                    <p class="text-sm font-bold">{{ $pesan->pengirim->username }}</p>
                                    <p class="text-sm">{{ $pesan->pesan }}</p>
                                    <p class="text-xs text-right mt-1 opacity-75">
                                        {{ $pesan->created_at->format('d M, H:i') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 p-8">Belum ada percakapan.</p>
                        @endforelse
                    </div>
                    <div class="p-4 border-t">
                        <form action="{{ route('komunikasi.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">
                            <div class="flex space-x-2">
                                <input type="text" name="pesan" class="flex-1 border rounded-full px-4 py-2"
                                    placeholder="Ketik pesan..." required>
                                <button type="submit"
                                    class="bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
