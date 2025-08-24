@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Tujuan Pembelajaran Baru</h1>
        <div class="bg-white p-8 rounded-lg shadow-md max-w-3xl mx-auto">
            <form action="{{ route('admin.atp.store') }}" method="POST">
                @include('admin.atp._form')
            </form>
        </div>
    </div>
@endsection
