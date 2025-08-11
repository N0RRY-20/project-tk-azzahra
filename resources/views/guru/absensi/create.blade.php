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
                                // Tentukan status dan warna latar belakang baris
                                $status = $absensiHariIni[$siswa->id_siswa]->status ?? 'Hadir';
                                $bgColorClass = match ($status) {
                                    'Hadir' => 'bg-green-50',
                                    'Izin', 'Sakit' => 'bg-yellow-50',
                                    'Alpa' => 'bg-red-50',
                                    default => '',
                                };
                            @endphp
                            <tr class="{{ $bgColorClass }}">
                                <td class="px-6 py-4 font-medium">{{ $siswa->nama_lengkap }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <label class="flex items-center"><input type="radio"
                                                name="absensi[{{ $siswa->id_siswa }}][status]" value="Hadir"
                                                {{ $status == 'Hadir' ? 'checked' : '' }} class="mr-1"> Hadir</label>
                                        <label class="flex items-center"><input type="radio"
                                                name="absensi[{{ $siswa->id_siswa }}][status]" value="Izin"
                                                {{ $status == 'Izin' ? 'checked' : '' }} class="mr-1"> Izin</label>
                                        <label class="flex items-center"><input type="radio"
                                                name="absensi[{{ $siswa->id_siswa }}][status]" value="Sakit"
                                                {{ $status == 'Sakit' ? 'checked' : '' }} class="mr-1"> Sakit</label>
                                        <label class="flex items-center"><input type="radio"
                                                name="absensi[{{ $siswa->id_siswa }}][status]" value="Alpa"
                                                {{ $status == 'Alpa' ? 'checked' : '' }} class="mr-1"> Alpa</label>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" name="absensi[{{ $siswa->id_siswa }}][keterangan]"
                                        class="w-full border rounded px-2 py-1 bg-white"
                                        value="{{ $absensiHariIni[$siswa->id_siswa]->keterangan ?? '' }}"
                                        placeholder="Opsional...">
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
