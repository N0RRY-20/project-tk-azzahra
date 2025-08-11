@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Jadwal Kegiatan Baru</h1>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <form action="{{ route('admin.jadwal-kegiatan.store') }}" method="POST">
                @include('admin.jadwal._form', ['jadwal' => new \App\Models\JadwalKegiatan()])
            </form>
        </div>
    </div>
@endsection
