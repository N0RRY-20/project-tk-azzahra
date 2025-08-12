@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">Detail Tagihan</h1>
                <p class="text-gray-600">{{ $tagihan->deskripsi }} - {{ $tagihan->siswa->nama_lengkap }}</p>
            </div>
            <a href="{{ route('admin.tagihan.index') }}" class="text-blue-500 hover:text-blue-700">Kembali</a>
        </div>

        @include('partials.success_message')

        {{-- Detail Tagihan & Pembayaran --}}
        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2 space-y-6">
                {{-- Daftar Pembayaran --}}
                <div class="bg-white shadow-md rounded-lg">
                    <div class="p-4 border-b flex justify-between items-center">
                        <h2 class="text-lg font-bold">Riwayat Pembayaran</h2>
                        @if ($tagihan->status !== 'Lunas')
                            <a href="{{ route('admin.pembayaran.create', $tagihan) }}"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded text-sm">+
                                Catat Pembayaran</a>
                        @endif
                    </div>
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 text-left">Tgl Bayar</th>
                                <th class="p-3 text-left">Jumlah</th>
                                <th class="p-3 text-left">Metode</th>
                                <th class="p-3 text-left">Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse($tagihan->pembayaran as $bayar)
                                <tr>
                                    <td class="p-3">{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d M Y') }}
                                    </td>
                                    <td class="p-3">Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td class="p-3">{{ $bayar->metode_bayar ?? '-' }}</td>
                                    <td class="p-3">{{ $bayar->admin->username }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-3 text-center text-gray-500">Belum ada pembayaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Ringkasan --}}
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-bold border-b pb-2 mb-4">Ringkasan</h2>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between"><span>Total Tagihan:</span> <span class="font-bold">Rp
                            {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</span></div>
                    @php $totalTerbayar = $tagihan->pembayaran->sum('jumlah_bayar'); @endphp
                    <div class="flex justify-between"><span>Total Terbayar:</span> <span class="font-bold text-green-600">Rp
                            {{ number_format($totalTerbayar, 0, ',', '.') }}</span></div>
                    <hr>
                    <div class="flex justify-between font-bold text-base"><span>Sisa Tagihan:</span> <span
                            class="text-red-600">Rp
                            {{ number_format($tagihan->jumlah_tagihan - $totalTerbayar, 0, ',', '.') }}</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection
