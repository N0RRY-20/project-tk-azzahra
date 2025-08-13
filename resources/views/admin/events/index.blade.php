@extends('layouts.admin')

@section('content')
    <div class="p-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Manajemen Event & Lomba</h1>
            <a href="{{ route('admin.events.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Buat Event Baru
            </a>
        </div>

        {{-- Pesan sukses --}}
        @include('partials.success_message')

        {{-- Tabel Event --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">Judul Event</th>
                        <th class="px-6 py-3 text-left font-semibold">Tanggal</th>
                        <th class="px-6 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($events as $event)
                        <tr>
                            {{-- Judul Event --}}
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.events.show', $event) }}"
                                    class="text-blue-600 hover:underline font-bold">
                                    {{ $event->judul }}
                                </a>
                            </td>

                            {{-- Tanggal Event --}}
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($event->tanggal_event)->format('d M Y') }}
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-right space-x-2">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.events.edit', $event) }}"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    Edit
                                </a>

                                {{-- Form Hapus --}}
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 cursor-pointer"> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-500">
                                Belum ada event yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
