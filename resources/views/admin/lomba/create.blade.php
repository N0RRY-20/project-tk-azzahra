@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800">Tambah Lomba Baru</h1>
        <p class="text-gray-600 mb-6">Untuk Event: {{ $event->judul }}</p>
        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="{{ route('admin.events.lomba.store', $event) }}" method="POST">
                @include('admin.lomba._form', ['lomba' => new \App\Models\EventLomba()])
            </form>
        </div>
    </div>
@endsection
