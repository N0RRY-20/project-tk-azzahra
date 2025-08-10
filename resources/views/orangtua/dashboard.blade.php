@extends('layouts.admin') {{-- Kita bisa pakai layout admin yang sama untuk kerangka --}}

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-2">Laporan Perkembangan</h1>
    <h2 class="text-xl text-gray-700 mb-6">Siswa: {{ $siswa->nama_lengkap }}</h2>

    <div class="bg-white shadow-md rounded-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold">Riwayat Laporan</h3>
        </div>
        <div class="border-t border-gray-200">
            @forelse ($laporanList as $laporan)
                <div class="p-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <p class="font-bold text-gray-800">{{ $laporan->aspek->kategori }}: {{ $laporan->capaian }}</p>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d M Y') }}</p>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">"{{ $laporan->aspek->deskripsi }}"</p>
                    @if($laporan->catatan_guru)
                    <div class="mt-2 p-3 bg-gray-50 rounded-md">
                        <p class="text-sm text-gray-800"><span class="font-semibold">Catatan dari {{ $laporan->guru->nama_lengkap }}:</span> {{ $laporan->catatan_guru }}</p>
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
</div>
@endsection