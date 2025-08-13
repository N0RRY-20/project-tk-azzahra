@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Buat Event Baru</h1>
        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="{{ route('admin.events.store') }}" method="POST">
                @include('admin.events._form', ['event' => new \App\Models\Event()])
            </form>
        </div>
    </div>
@endsection
