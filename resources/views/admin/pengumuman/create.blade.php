@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Buat Pengumuman / Event Baru</h1>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST">
                @include('admin.pengumuman._form')
            </form>
        </div>
    </div>
@endsection
