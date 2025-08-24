@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Tujuan Pembelajaran</h1>
        <div class="bg-white p-8 rounded-lg shadow-md max-w-3xl mx-auto">
            <form action="{{ route('admin.atp.update', $atp) }}" method="POST">
                @method('PUT')
                @include('admin.atp._form')
            </form>
        </div>
    </div>
@endsection
