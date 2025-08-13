@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Event</h1>
        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="{{ route('admin.events.update', $event) }}" method="POST">
                @method('PUT')
                @include('admin.events._form')
            </form>
        </div>
    </div>
@endsection
