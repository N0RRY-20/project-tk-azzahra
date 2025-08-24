@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Supervisi RPP</h1>
        <p class="text-gray-600 mb-6">Pilih seorang guru untuk melihat semua Rencana Pelaksanaan Pembelajaran (RPP) yang
            telah dibuat.</p>

        <div class="bg-white shadow-md rounded-lg">
            <div class="divide-y divide-gray-200">
                @forelse ($guruList as $guru)
                    <a href="{{ route('admin.supervisi-rpp.show', $guru) }}" class="block p-4 hover:bg-gray-50">
                        <p class="font-semibold text-blue-600">{{ $guru->nama_lengkap }}</p>
                        <p class="text-sm text-gray-500">{{ $guru->user->username }}</p>
                    </a>
                @empty
                    <p class="p-4 text-center text-gray-500">Belum ada data guru.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
