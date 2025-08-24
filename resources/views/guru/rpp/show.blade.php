@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">{{ $rppm->tema }}</h1>
            <p class="text-gray-600">{{ $rppm->sub_tema }} | Minggu ke-{{ $rppm->minggu_ke }} {{ $rppm->bulan }}</p>
        </div>

        <div class="flex justify-between items-center my-6">
            <h2 class="text-xl text-gray-700">Rencana Pelaksanaan Pembelajaran Harian (RPPH)</h2>
            <a href="{{ route('guru.rppm.rpph.create', $rppm) }}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded text-sm">+ Tambah RPPH</a>
        </div>

        @include('partials.success_message')

        <div class="space-y-4">
            @forelse ($rppm->rpph->sortBy('tanggal') as $rpph)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-lg">
                            {{ \Carbon\Carbon::parse($rpph->tanggal)->isoFormat('dddd, D MMMM Y') }}</h3>

                        {{-- Bagian Aksi (Tombol Edit & Hapus) --}}
                        <div class="text-sm font-medium">
                            <a href="{{ route('guru.rpph.edit', $rpph) }}"
                                class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="{{ route('guru.rpph.destroy', $rpph) }}" method="POST" class="inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus RPPH ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-2 text-sm space-y-2">
                        <p><strong>Pembuka:</strong> {{ $rpph->kegiatan_pembuka ?: '-' }}</p>
                        <p><strong>Inti:</strong> {{ $rpph->kegiatan_inti ?: '-' }}</p>
                        <p><strong>Penutup:</strong> {{ $rpph->kegiatan_penutup ?: '-' }}</p>
                        <p><strong>Alat & Bahan:</strong> {{ $rpph->alat_dan_bahan ?: '-' }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 p-8 bg-white rounded-lg">Belum ada RPPH untuk minggu ini.</p>
            @endforelse
        </div>
    </div>
@endsection
