@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-800">Detail Siswa: {{ $siswa->nama_lengkap }}</h1>
            <a href="{{ route('guru.dashboard') }}" class="text-blue-500 hover:text-blue-700">Kembali ke Dashboard</a>
        </div>
        <p class="text-gray-600">Kelas: {{ $siswa->kelas->nama_kelas }}</p>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <h4 class="font-bold text-yellow-800">Riwayat Kesehatan</h4>
                <p class="text-yellow-700 mt-1">{{ $siswa->riwayat_kesehatan ?: 'Tidak ada data.' }}</p>
            </div>
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                <h4 class="font-bold text-blue-800">Catatan Khusus Orang Tua</h4>
                <p class="text-blue-700 mt-1">{{ $siswa->catatan_khusus_ortu ?: 'Tidak ada data.' }}</p>
            </div>
        </div>

        <hr class="my-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- BAGIAN BUKU KOMUNIKASI --}}
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Buku Komunikasi Digital</h3>
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

        <hr class="my-6">

        <h2 class="text-xl text-gray-700 mb-4">Riwayat Laporan Perkembangan</h2>


        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left ...">Tanggal</th>
                        <th class="px-6 py-3 text-left ...">Aspek Dinilai</th>
                        <th class="px-6 py-3 text-left ...">Capaian</th>
                        <th class="px-6 py-3 text-left ...">Guru</th>
                        <th class="px-6 py-3 text-right ...">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($siswa->laporanPerkembangan as $laporan)
                        <tr>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">{{ $laporan->aspek->deskripsi }}</td>
                            <td class="px-6 py-4">{{ $laporan->capaian }}</td>
                            <td class="px-6 py-4">{{ $laporan->guru->nama_lengkap }}</td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                {{-- Tampilkan tombol hanya jika guru yang login adalah pembuat laporan --}}
                                @if ($laporan->id_guru === Auth::user()->guruProfil->id_guru)
                                    <a href="{{ route('guru.laporan.edit', $laporan->id_laporan) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                    <form action="{{ route('guru.laporan.destroy', $laporan->id_laporan) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Belum ada laporan perkembangan untuk siswa ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
