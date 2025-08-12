@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Tagihan</h1>
        <p class="text-gray-600 mb-6">Untuk: {{ $tagihan->siswa->nama_lengkap }}</p>

        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="{{ route('admin.tagihan.update', $tagihan) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pilihan Siswa --}}
                <div class="mb-4">
                    <label for="id_siswa" class="block text-gray-700 font-bold mb-2">Untuk Siswa</label>
                    <select name="id_siswa" id="id_siswa"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswaList as $siswa)
                            <option value="{{ $siswa->id_siswa }}"
                                {{ old('id_siswa', $tagihan->id_siswa) == $siswa->id_siswa ? 'selected' : '' }}>
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
                        value="{{ old('deskripsi', $tagihan->deskripsi) }}" required>
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
                            value="{{ old('jumlah_tagihan', $tagihan->jumlah_tagihan) }}" required>
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
                            value="{{ old('tanggal_jatuh_tempo', $tagihan->tanggal_jatuh_tempo) }}" required>
                        @error('tanggal_jatuh_tempo')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Status Pembayaran --}}
                <div class="mb-6">
                    <label for="status" class="block text-gray-700 font-bold mb-2">Status Pembayaran</label>
                    <select name="status" id="status"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        <option value="Belum Lunas"
                            {{ old('status', $tagihan->status) == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="Sebagian" {{ old('status', $tagihan->status) == 'Sebagian' ? 'selected' : '' }}>
                            Sebagian</option>
                        <option value="Lunas" {{ old('status', $tagihan->status) == 'Lunas' ? 'selected' : '' }}>Lunas
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.tagihan.index') }}"
                        class="text-sm text-gray-600 hover:text-gray-800 mr-4">Batal</a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Perbarui Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
