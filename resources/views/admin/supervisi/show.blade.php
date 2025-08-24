@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Supervisi RPP - {{ $guru->nama_lengkap }}</h1>
            <a href="{{ route('admin.supervisi-rpp.index') }}" class="text-sm text-blue-500 hover:text-blue-700">&larr;
                Kembali ke daftar guru</a>
        </div>

        @forelse($guru->rppm as $rppm)
            <div class="bg-white shadow-md rounded-lg mb-6">
                <div class="p-4 bg-gray-50 border-b rounded-t-lg">
                    <h2 class="text-xl font-bold text-gray-700">{{ $rppm->tema }} - {{ $rppm->sub_tema }}</h2>
                    <p class="text-sm text-gray-600">Minggu ke-{{ $rppm->minggu_ke }} {{ $rppm->bulan }}, Semester
                        {{ $rppm->semester }}</p>
                </div>
                <div class="p-4 space-y-2">
                    @forelse($rppm->rpph->sortBy('tanggal') as $rpph)
                        <div class="p-2 border rounded">
                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($rpph->tanggal)->isoFormat('dddd, D MMMM Y') }}</p>
                            <p class="text-xs mt-1"><strong>Inti:</strong> {{ $rpph->kegiatan_inti ?: '-' }}</p>
                            <p class="text-xs mt-1"><strong>Pembuka:</strong> {{ $rpph->kegiatan_pembuka ?: '-' }}</p>
                            <p class="text-xs mt-1"><strong>Inti:</strong> {{ $rpph->kegiatan_inti ?: '-' }}</p>
                            <p class="text-xs mt-1"><strong>Penutup:</strong> {{ $rpph->kegiatan_penutup ?: '-' }}</p>
                            <p class="text-xs mt-1"><strong>Alat & Bahan:</strong> {{ $rpph->alat_dan_bahan ?: '-' }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 italic">Belum ada RPPH untuk minggu ini.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 p-8 bg-white rounded-lg">Guru ini belum membuat RPPM.</p>
        @endforelse
    </div>
@endsection
