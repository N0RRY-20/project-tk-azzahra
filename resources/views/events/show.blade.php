@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">{{ $event->judul }}</h1>
                <p class="text-gray-600">{{ \Carbon\Carbon::parse($event->tanggal_event)->format('d F Y') }}</p>
                <p class="mt-2 text-gray-700">{{ $event->deskripsi }}</p>
            </div>
            <a href="{{ route('events.index') }}" class="text-blue-500 hover:text-blue-700">Kembali ke Daftar Event</a>
        </div>

        @include('partials.success_message')
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="space-y-4">
            @foreach ($event->lomba as $lomba)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="font-bold text-lg">{{ $lomba->nama_lomba }}</h3>
                    <p class="text-sm text-gray-500">{{ $lomba->keterangan }}</p>
                    <p class="text-sm font-semibold">Kuota: {{ $lomba->pendaftaran->count() }} / {{ $lomba->kuota }}</p>

                    <div class="mt-3 border-t pt-3">
                        <h4 class="text-xs uppercase font-bold text-gray-500 mb-2">Pendaftar:</h4>
                        <ul class="list-disc list-inside text-sm">
                            @forelse($lomba->pendaftaran as $pendaftar)
                                <li>{{ $pendaftar->nama_pendaftar }}</li>
                            @empty
                                <li class="list-none text-gray-400 italic">Jadilah yang pertama mendaftar!</li>
                            @endforelse
                        </ul>
                    </div>

                    {{-- Tombol Aksi hanya untuk Orang Tua --}}
                    @if (Auth::user()->peran === 'orangtua')
                        <div class="mt-4 border-t pt-4">
                            @php
                                // Cek apakah user terdaftar di LOMBA SPESIFIK INI
                                $pendaftaranUser = $lomba->pendaftaran->firstWhere('id_orangtua', Auth::id());
                            @endphp

                            @if ($pendaftaranUser)
                                {{-- Tampilan jika sudah terdaftar di LOMBA INI --}}
                                <div class="flex justify-between items-center">
                                    <p class="text-sm text-green-600 font-bold">
                                        Anda sudah terdaftar sebagai: {{ $pendaftaranUser->status_pendaftar }}
                                        {{ $pendaftaranUser->nama_pendaftar }}
                                    </p>
                                    <form action="{{ route('lomba.batal') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id_lomba" value="{{ $lomba->id_lomba }}">
                                        <button type="submit"
                                            class="bg-red-500 text-white font-bold py-2 px-4 rounded text-sm">Batal
                                            Daftar</button>
                                    </form>
                                </div>
                            @elseif($userHasRegistered)
                                {{-- Tampilan jika sudah terdaftar di LOMBA LAIN --}}
                                <p class="text-sm font-semibold text-gray-500 p-2 bg-gray-100 rounded-md">Anda sudah
                                    terdaftar di lomba lain pada event ini.</p>
                            @elseif($lomba->pendaftaran->count() < $lomba->kuota)
                                {{-- Form Daftar jika belum terdaftar sama sekali dan kuota ada --}}
                                <form action="{{ route('lomba.daftar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_lomba" value="{{ $lomba->id_lomba }}">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
                                        <select name="status_pendaftar" class="border rounded px-2 py-1.5 text-sm" required>
                                            <option value="">Daftar sebagai...</option>
                                            <option value="Ayah">Ayah</option>
                                            <option value="Bunda">Bunda</option>
                                        </select>
                                        <input type="text" name="nama_pendaftar"
                                            class="border rounded px-2 py-1.5 text-sm md:col-span-1"
                                            placeholder="Ketik nama Anda" required>
                                        <button type="submit"
                                            class="bg-green-500 text-white font-bold py-2 px-3 rounded text-sm w-full">Daftar</button>
                                    </div>
                                </form>
                            @else
                                <p class="text-sm font-bold text-red-500">Kuota Penuh</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
