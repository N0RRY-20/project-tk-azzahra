@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800">Edit Rencana Harian (RPPH)</h1>
        <p class="text-gray-600 mb-6">Untuk tanggal: {{ \Carbon\Carbon::parse($rpph->tanggal)->isoFormat('dddd, D MMMM Y') }}
        </p>
        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="{{ route('guru.rpph.update', $rpph) }}" method="POST">
                @method('PUT')
                @include('guru.rpp.rpph._form')
            </form>
        </div>
    </div>
@endsection
