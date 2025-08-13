@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">{{ $event->judul }}</h1>
                <p class="text-gray-600">{{ \Carbon\Carbon::parse($event->tanggal_event)->format('d F Y') }}</p>
                <p class="mt-2 text-gray-700">{{ $event->deskripsi }}</p>
            </div>
            <a href="{{ route('admin.events.index') }}" class="text-blue-500 hover:text-blue-700">Kembali</a>
        </div>

        <div class="flex justify-between items-center my-6">
            <h2 class="text-xl text-gray-700">Daftar Perlombaan</h2>
            <a href="{{ route('admin.events.lomba.create', $event) }}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded text-sm">+ Tambah Lomba</a>
        </div>

        @include('partials.success_message')

        <div class="space-y-4">
            @forelse ($event->lomba as $lomba)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg">{{ $lomba->nama_lomba }}</h3>
                            <p class="text-sm text-gray-500">{{ $lomba->keterangan }}</p>
                            <p class="text-sm font-semibold">Kuota: {{ $lomba->pendaftaran->count() }} / {{ $lomba->kuota }}
                            </p>
                        </div>
                        <div class="text-sm">
                            <a href="{{ route('admin.lomba.edit', $lomba) }}"
                                class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            {{-- Form Hapus --}}
                            <form action="{{ route('admin.lomba.destroy', $lomba) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- Daftar Pendaftar --}}
                    <div class="mt-3 border-t pt-3">
                        <h4 class="text-xs uppercase font-bold text-gray-500 mb-2">Pendaftar:</h4>
                        <ul class="list-disc list-inside text-sm">
                            @forelse($lomba->pendaftaran as $pendaftar)
                                <li>{{ $pendaftar->nama_pendaftar }} (Wali dari:
                                    {{ $pendaftar->orangtua->siswaAsOrangtua->nama_lengkap ?? 'N/A' }})</li>
                            @empty
                                <li class="list-none text-gray-400 italic">Belum ada yang mendaftar.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 p-8 bg-white rounded-lg">Belum ada jenis lomba yang ditambahkan untuk
                    event ini.</p>
            @endforelse
        </div>
    </div>
@endsection
