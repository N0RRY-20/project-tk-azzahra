@extends('layouts.admin')
@section('content')
    <div class="p-6">
        {{-- di file admin/keuangan/tagihan/index.blade.php --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Manajemen Keuangan</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.tagihan.createMassal') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Generate SPP Massal
                </a>
                <a href="{{ route('admin.tagihan.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Buat Tagihan Satuan
                </a>
            </div>
        </div>

        @include('partials.success_message')
        {{-- =============================================================== --}}
        {{--                  BAGIAN BARU UNTUK HAPUS MASSAL                  --}}
        {{-- =============================================================== --}}
        <div class="bg-red-50 border border-red-200 p-4 rounded-lg shadow-md mb-6">
            <h3 class="font-bold text-red-800 mb-2">Aksi Hapus Massal (Hati-hati)</h3>
            <form action="{{ route('admin.tagihan.destroyMassal') }}" method="POST"
                onsubmit="return confirm('PERINGATAN: Anda akan menghapus semua tagihan \'Belum Lunas\' dengan deskripsi yang dipilih. Aksi ini tidak bisa diurungkan. Lanjutkan?');">
                @csrf
                <div class="flex items-center space-x-4">
                    <select name="deskripsi_massal" class="flex-1 rounded-md border-gray-300 shadow-sm" required>
                        <option value="">-- Pilih Deskripsi Tagihan --</option>
                        @foreach ($deskripsiList as $item)
                            <option value="{{ $item->deskripsi }}">{{ $item->deskripsi }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">
                        Hapus Massal
                    </button>
                </div>
            </form>
        </div>

        @include('partials.success_message')
        @if (session('error'))
            {{-- Jangan lupa tambahkan ini di partials jika belum ada --}}
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif
        {{-- ... sisa kode tabel tagihan ... --}}

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
