@extends('layouts.admin')

{{-- Bagian konten --}}
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- HAPUS KARTU "JUMLAH SISWA AKTIF" YANG LAMA, GANTI DENGAN DUA KARTU INI --}}

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                    <svg class="h-8 w-8 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Siswa Laki-laki</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $jumlahSiswaLaki }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-pink-500 bg-opacity-20">
                    <svg class="h-8 w-8 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Siswa Perempuan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $jumlahSiswaPerempuan }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 bg-opacity-20">
                    <svg class="h-8 w-8 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Jumlah Guru</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $jumlahGuru }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20">
                    <svg class="h-8 w-8 text-yellow-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2" />
                        <rect x="9" y="3" width="6" height="4" rx="2" />
                        <line x1="9" y1="12" x2="9.01" y2="12" />
                        <line x1="13" y1="12" x2="15" y2="12" />
                        <line x1="9" y1="16" x2="9.01" y2="16" />
                        <line x1="13" y1="16" x2="15" y2="16" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Laporan Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $laporanHariIni }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-500 bg-opacity-20">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Guru Hadir Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $guruHadirHariIni }}</p>
                </div>
            </div>
        </div>

    </div>
@endsection
