@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Event & Lomba Sekolah</h1>
        <div class="space-y-4">
            @forelse($events as $event)
                <a href="{{ route('events.show', $event) }}" class="block bg-white shadow-md rounded-lg p-4 hover:bg-gray-50">
                    <p class="font-bold text-blue-600">{{ $event->judul }}</p>
                    <p class="text-sm text-gray-600">Tanggal:
                        {{ \Carbon\Carbon::parse($event->tanggal_event)->format('d F Y') }}</p>
                </a>
            @empty
                <p class="text-center text-gray-500">Belum ada event yang akan datang.</p>
            @endforelse
        </div>
    </div>
@endsection
