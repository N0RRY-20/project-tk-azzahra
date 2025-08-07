@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Data Siswa: {{ $siswa->nama_lengkap }}</h1>
    
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.siswa.update', $siswa->id_siswa) }}" method="POST">
            @method('PUT')
            @include('admin.siswa._form')
        </form>
    </div>
</div>
@endsection