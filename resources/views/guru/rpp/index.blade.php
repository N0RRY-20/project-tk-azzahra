@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Manajemen RPP</h1>
            <a href="{{ route('guru.rppm.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Buat RPPM Baru</a>
        </div>
        @include('partials.success_message')
        <div class="bg-white shadow-md rounded-lg">
            <div class="divide-y divide-gray-200">
                @forelse ($rppmList as $rppm)
                    <div class="p-4 flex justify-between items-center hover:bg-gray-50">
                        {{-- Bagian Info (Link ke Halaman Detail) --}}
                        <a href="{{ route('guru.rppm.show', $rppm) }}" class="flex-1">
                            <p class="font-bold text-blue-600 hover:underline">{{ $rppm->tema }} - {{ $rppm->sub_tema }}
                            </p>
                            <p class="text-sm text-gray-600">Minggu ke-{{ $rppm->minggu_ke }} {{ $rppm->bulan }}, Semester
                                {{ $rppm->semester }} {{ $rppm->tahun_ajaran }}</p>
                        </a>

                        {{-- Bagian Aksi (Tombol Edit & Hapus) --}}
                        <div class="text-sm font-medium">
                            <a href="{{ route('guru.rppm.edit', $rppm) }}"
                                class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="{{ route('guru.rppm.destroy', $rppm) }}" method="POST" class="inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus RPPM ini beserta semua RPPH di dalamnya?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 p-8">Belum ada RPPM yang dibuat.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
