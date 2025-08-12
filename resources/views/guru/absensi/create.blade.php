@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Absensi Siswa - {{ $kelas->nama_kelas }}</h1>
        <p class="text-gray-600 mb-4">Tanggal: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('guru.absensi.store') }}" method="POST">
            @csrf
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                                Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status Kehadiran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kelas->siswa as $siswa)
                            @php
                                $absensi = $absensiHariIni[$siswa->id_siswa] ?? null;
                                $status = $absensi->status ?? 'Hadir';
                            @endphp
                            {{-- Logika x-data sekarang juga mengenali 'Terlambat' --}}
                            <tr x-data="{ status: '{{ $status }}' }"
                                class="{{ $status == 'Hadir' || $status == 'Terlambat' ? 'bg-green-50' : ($status == 'Alpa' ? 'bg-red-50' : 'bg-yellow-50') }}">
                                <td class="px-6 py-4 font-medium">{{ $siswa->nama_lengkap }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4 text-sm flex-wrap">
                                        <label class="flex items-center mr-2 mb-1"><input type="radio" x-model="status"
                                                name="absensi[{{ $siswa->id_siswa }}][status]" value="Hadir"
                                                class="mr-1"> Hadir</label>
                                        {{-- TOMBOL RADIO BARU --}}
                                        <label class="flex items-center mr-2 mb-1"><input type="radio" x-model="status"
                                                name="absensi[{{ $siswa->id_siswa }}][status]" value="Terlambat"
                                                class="mr-1"> Terlambat</label>
                                        <label class="flex items-center mr-2 mb-1"><input type="radio" x-model="status"
                                                name="absensi[{{ $siswa->id_siswa }}][status]" value="Izin"
                                                class="mr-1"> Izin</label>
                                        <label class="flex items-center mr-2 mb-1"><input type="radio" x-model="status"
                                                name="absensi[{{ $siswa->id_siswa }}][status]" value="Sakit"
                                                class="mr-1"> Sakit</label>
                                        <label class="flex items-center mr-2 mb-1"><input type="radio" x-model="status"
                                                name="absensi[{{ $siswa->id_siswa }}][status]" value="Alpa"
                                                class="mr-1"> Alpa</label>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{-- Input jam hadir, muncul jika status 'Hadir' atau 'Terlambat' --}}
                                    <div x-show="status === 'Hadir' || status === 'Terlambat'"
                                        class="flex items-center space-x-2">
                                        <label for="waktu_hadir_{{ $siswa->id_siswa }}" class="text-sm">Jam Hadir:</label>
                                        <input type="time" name="absensi[{{ $siswa->id_siswa }}][waktu_hadir]"
                                            id="waktu_hadir_{{ $siswa->id_siswa }}" class="border rounded px-2 py-1 w-28"
                                            value="{{ $absensi->waktu_hadir ?? '' }}">
                                    </div>
                                    {{-- Input keterangan, muncul jika status BUKAN 'Hadir' atau 'Terlambat' --}}
                                    <div x-show="status !== 'Hadir' && status !== 'Terlambat'">
                                        <input type="text" name="absensi[{{ $siswa->id_siswa }}][keterangan]"
                                            class="w-full border rounded px-2 py-1"
                                            value="{{ $absensi->keterangan ?? '' }}"
                                            placeholder="Keterangan (opsional)...">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Absensi
                </button>
            </div>
        </form>
    </div>
@endsection
