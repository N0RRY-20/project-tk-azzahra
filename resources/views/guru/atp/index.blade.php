@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Alur Tujuan Pembelajaran (ATP)</h1>
            <p class="text-gray-600">Gunakan sebagai acuan utama dalam menyusun Rencana Pembelajaran (RPP).</p>
        </div>

        <div class="space-y-8">
            @forelse ($atpGrouped as $tahunAjaran => $semesters)
                <div class="bg-white shadow-md rounded-lg">
                    <div class="p-4 border-b bg-gray-50 rounded-t-lg">
                        <h2 class="text-xl font-bold text-gray-700">Tahun Ajaran {{ $tahunAjaran }}</h2>
                    </div>

                    @foreach ($semesters as $semester => $atpList)
                        <div class="p-4 border-b">
                            <h3 class="text-lg font-semibold text-indigo-700">Semester {{ $semester }}</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach ($atpList as $item)
                                <div class="p-4">
                                    <p class="font-semibold text-gray-800">{{ $item->urutan }}.
                                        {{ $item->elemen_kurikulum }}</p>
                                    <p class="text-sm text-gray-600 pl-6">{{ $item->tujuan_pembelajaran }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="bg-white shadow-md rounded-lg p-8 text-center text-gray-500">
                    <p>Admin belum membuat Alur Tujuan Pembelajaran.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
