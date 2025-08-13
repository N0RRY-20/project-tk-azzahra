@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800">Edit Lomba</h1>
        <p class="text-gray-600 mb-6">Event: {{ $lomba->event->judul }}</p>
        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="{{ route('admin.lomba.update', $lomba) }}" method="POST">
                @method('PUT')
                @include('admin.lomba._form')
            </form>
        </div>
    </div>
@endsection
