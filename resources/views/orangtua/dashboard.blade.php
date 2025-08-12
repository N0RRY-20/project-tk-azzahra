@extends('layouts.admin') {{-- Kita bisa pakai layout admin yang sama untuk kerangka --}}

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-2">Laporan Perkembangan</h1>
        <h2 class="text-xl text-gray-700 mb-6">Siswa: {{ $siswa->nama_lengkap }}</h2>

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
        <div class="bg-white shadow-md rounded-lg mt-8">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Buku Komunikasi dengan Guru</h3>
            </div>
            <div class="p-4 h-96 overflow-y-auto space-y-4">
                {{-- Loop untuk menampilkan pesan --}}
                @forelse ($siswa->komunikasi as $pesan)
                    <div class="flex {{ $pesan->pengirim->id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div
                            class="max-w-xs md:max-w-md p-3 rounded-lg {{ $pesan->pengirim->id === Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                            <p class="text-sm font-bold">{{ $pesan->pengirim->username }}</p>
                            <p class="text-sm">{{ $pesan->pesan }}</p>
                            <p class="text-xs text-right mt-1 opacity-75">{{ $pesan->created_at->format('d M, H:i') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada percakapan.</p>
                @endforelse
            </div>
            <div class="p-4 border-t">
                {{-- Form untuk mengirim pesan --}}
                <form action="{{ route('komunikasi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">
                    <div class="flex space-x-2">
                        <input type="text" name="pesan"
                            class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Ketik pesan..." required>
                        <button type="submit"
                            class="bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600">Kirim</button>
                    </div>
                </form>
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
                                    @php
                                        $status = $absen->status;
                                        $badgeColor = match ($status) {
                                            'Hadir' => 'bg-green-100 text-green-800',
                                            'Terlambat' => 'bg-yellow-100 text-yellow-800',
                                            'Izin', 'Sakit' => 'bg-blue-100 text-blue-800',
                                            'Alpa' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeColor }}">
                                        {{ $status }}
                                        {{-- Tampilkan jam jika statusnya Hadir atau Terlambat dan waktunya diisi --}}
                                        @if (($status == 'Hadir' || $status == 'Terlambat') && $absen->waktu_hadir)
                                            ({{ date('H:i', strtotime($absen->waktu_hadir)) }})
                                        @endif
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
