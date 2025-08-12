@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Buat Tagihan Baru</h1>

        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="{{ route('admin.tagihan.store') }}" method="POST">
                @csrf

                {{-- Pilihan Siswa --}}
                <div class="mb-4">
                    <label for="id_siswa" class="block text-gray-700 font-bold mb-2">Untuk Siswa</label>
                    <select name="id_siswa" id="id_siswa"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswaList as $siswa)
                            <option value="{{ $siswa->id_siswa }}"
                                {{ old('id_siswa') == $siswa->id_siswa ? 'selected' : '' }}>
                                {{ $siswa->nama_lengkap }} (Kelas: {{ $siswa->kelas->nama_kelas }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_siswa')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi Tagihan --}}
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                    <input type="text" name="deskripsi" id="deskripsi"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                        value="{{ old('deskripsi') }}" placeholder="Contoh: SPP Bulan Agustus 2025" required>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Jumlah Tagihan --}}
                    <div class="mb-4">
                        <label for="jumlah_tagihan" class="block text-gray-700 font-bold mb-2">Jumlah (Rp)</label>
                        <input type="number" name="jumlah_tagihan" id="jumlah_tagihan"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                            value="{{ old('jumlah_tagihan') }}" placeholder="Contoh: 300000" required>
                        @error('jumlah_tagihan')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Jatuh Tempo --}}
                    <div class="mb-4">
                        <label for="tanggal_jatuh_tempo" class="block text-gray-700 font-bold mb-2">Tanggal Jatuh
                            Tempo</label>
                        <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                            value="{{ old('tanggal_jatuh_tempo') }}" required>
                        @error('tanggal_jatuh_tempo')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.tagihan.index') }}"
                        class="text-sm text-gray-600 hover:text-gray-800 mr-4">Batal</a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
