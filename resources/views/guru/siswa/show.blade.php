@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-800">Detail Siswa: {{ $siswa->nama_lengkap }}</h1>
        <a href="{{ route('guru.dashboard') }}" class="text-blue-500 hover:text-blue-700">Kembali ke Dashboard</a>
    </div>
    <p class="text-gray-600">Kelas: {{ $siswa->kelas->nama_kelas }}</p>

    <hr class="my-6">

    <h2 class="text-xl text-gray-700 mb-4">Riwayat Laporan Perkembangan</h2>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
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
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ $laporan->aspek->deskripsi }}</td>
                        <td class="px-6 py-4">{{ $laporan->capaian }}</td>
                        <td class="px-6 py-4">{{ $laporan->guru->nama_lengkap }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            {{-- Tampilkan tombol hanya jika guru yang login adalah pembuat laporan --}}
                            @if ($laporan->id_guru === Auth::user()->guruProfil->id_guru)
                                <a href="{{ route('guru.laporan.edit', $laporan->id_laporan) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                <form action="{{ route('guru.laporan.destroy', $laporan->id_laporan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
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