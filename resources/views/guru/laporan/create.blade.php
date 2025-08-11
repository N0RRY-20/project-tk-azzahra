@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Laporan untuk {{ $siswa->nama_lengkap }}</h1>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <form action="{{ route('guru.laporan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">

                {{-- Tanggal Laporan --}}
                <div class="mb-4">
                    <label for="tanggal_laporan" class="block text-gray-700 font-bold mb-2">Tanggal Laporan</label>
                    <input type="date" name="tanggal_laporan" id="tanggal_laporan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                        value="{{ date('Y-m-d') }}" required>
                    @error('tanggal_laporan')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Aspek Penilaian --}}
                <div class="mb-4">
                    <label for="id_aspek" class="block text-gray-700 font-bold mb-2">Aspek Penilaian</label>
                    <select name="id_aspek" id="id_aspek"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        <option value="">Pilih Aspek...</option>
                        @foreach ($aspekList as $aspek)
                            <option value="{{ $aspek->id_aspek }}">{{ $aspek->kategori }}: {{ $aspek->deskripsi }}</option>
                        @endforeach
                    </select>
                    @error('id_aspek')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Capaian --}}
                <div class="mb-4">
                    <label for="capaian" class="block text-gray-700 font-bold mb-2">Capaian</label>
                    <select name="capaian" id="capaian"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        <option value="">Pilih Capaian...</option>
                        <option value="Belum Berkembang">Belum Berkembang</option>
                        <option value="Mulai Berkembang">Mulai Berkembang</option>
                        <option value="Berkembang Sesuai Harapan">Berkembang Sesuai Harapan</option>
                        <option value="Berkembang Sangat Baik">Berkembang Sangat Baik</option>
                    </select>
                    @error('capaian')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Catatan Guru --}}
                <div class="mb-6">
                    <label for="catatan_guru" class="block text-gray-700 font-bold mb-2">Catatan Guru (Opsional)</label>
                    <textarea name="catatan_guru" id="catatan_guru" rows="4"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></textarea>
                    @error('catatan_guru')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Laporan
                    </button>
                    <a href="{{ route('guru.dashboard') }}"
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
