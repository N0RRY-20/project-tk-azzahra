@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Manajemen Keuangan</h1>
            <a href="{{ route('admin.tagihan.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Buat Tagihan Baru
            </a>
        </div>

        @include('partials.success_message')

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left ...">Siswa</th>
                        <th class="px-6 py-3 text-left ...">Deskripsi</th>
                        <th class="px-6 py-3 text-left ...">Jumlah</th>
                        <th class="px-6 py-3 text-left ...">Jatuh Tempo</th>
                        <th class="px-6 py-3 text-left ...">Status</th>
                        <th class="px-6 py-3 text-right ...">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($tagihanList as $tagihan)
                        <tr>
                            <td class="px-6 py-4">{{ $tagihan->siswa->nama_lengkap }}</td>
                            <td class="px-6 py-4">{{ $tagihan->deskripsi }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($tagihan->tanggal_jatuh_tempo)->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match ($tagihan->status) {
                                        'Lunas' => 'bg-green-100 text-green-800',
                                        'Sebagian' => 'bg-yellow-100 text-yellow-800',
                                        default => 'bg-red-100 text-red-800',
                                    };
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                    {{ $tagihan->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('admin.tagihan.show', $tagihan) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-4">Detail</a>
                                <a href="{{ route('admin.tagihan.edit', $tagihan) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center">Belum ada data tagihan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
