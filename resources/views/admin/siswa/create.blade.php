@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Siswa Baru</h1>
    
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.siswa.store') }}" method="POST">
            @include('admin.siswa._form')
        </form>
    </div>
</div>
@endsection