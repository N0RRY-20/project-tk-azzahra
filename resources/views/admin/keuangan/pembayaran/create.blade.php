@extends('layouts.admin')
@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800">Catat Pembayaran</h1>
        <p class="text-gray-600 mb-6">Untuk tagihan: {{ $tagihan->deskripsi }} ({{ $tagihan->siswa->nama_lengkap }})</p>

        <div class="bg-white p-8 rounded-lg shadow-md max-w-lg mx-auto">
            <form action="{{ route('admin.pembayaran.store', $tagihan) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="jumlah_bayar" class="block text-gray-700 font-bold mb-2">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" id="jumlah_bayar"
                        class="shadow border rounded w-full py-2 px-3" required>
                </div>
                <div class="mb-4">
                    <label for="tanggal_bayar" class="block text-gray-700 font-bold mb-2">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" id="tanggal_bayar"
                        class="shadow border rounded w-full py-2 px-3" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-4">
                    <label for="metode_bayar" class="block text-gray-700 font-bold mb-2">Metode Bayar (Opsional)</label>
                    <input type="text" name="metode_bayar" id="metode_bayar"
                        class="shadow border rounded w-full py-2 px-3" placeholder="Contoh: Tunai, Transfer BCA">
                </div>
                <div class="mb-6">
                    <label for="catatan_admin" class="block text-gray-700 font-bold mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan_admin" id="catatan_admin" rows="3" class="shadow border rounded w-full py-2 px-3"></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan
                        Pembayaran</button>
                    <a href="{{ route('admin.tagihan.show', $tagihan) }}"
                        class="text-sm text-blue-500 hover:text-blue-800">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
