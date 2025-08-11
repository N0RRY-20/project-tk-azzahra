@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Jadwal Kegiatan</h1>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <form action="{{ route('admin.jadwal-kegiatan.update', $jadwal->id_jadwal) }}" method="POST">
                @method('PUT')
                @include('admin.jadwal._form')
            </form>
        </div>
    </div>
@endsection
