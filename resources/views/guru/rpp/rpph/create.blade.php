@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800">Tambah Rencana Harian (RPPH)</h1>
        <p class="text-gray-600 mb-6">Untuk RPPM: {{ $rppm->tema }} - {{ $rppm->sub_tema }}</p>
        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="{{ route('guru.rppm.rpph.store', $rppm) }}" method="POST">
                @include('guru.rpp.rpph._form')
            </form>
        </div>
    </div>
@endsection
