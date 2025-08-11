@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Laporan untuk {{ $siswa->nama_lengkap }}</h1>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <form action="{{ route('guru.laporan.update', $laporan->id_laporan) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Tanggal Laporan --}}
                <div class="mb-4">
                    <label for="tanggal_laporan" class="block text-gray-700 font-bold mb-2">Tanggal Laporan</label>
                    <input type="date" name="tanggal_laporan" id="tanggal_laporan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                        value="{{ old('tanggal_laporan', $laporan->tanggal_laporan) }}" required>
                </div>

                {{-- Aspek Penilaian --}}
                <div class="mb-4">
                    <label for="id_aspek" class="block text-gray-700 font-bold mb-2">Aspek Penilaian</label>
                    <select name="id_aspek" id="id_aspek"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        @foreach ($aspekList as $aspek)
                            <option value="{{ $aspek->id_aspek }}"
                                {{ $laporan->id_aspek == $aspek->id_aspek ? 'selected' : '' }}>
                                {{ $aspek->kategori }}: {{ $aspek->deskripsi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Capaian --}}
                <div class="mb-4">
                    <label for="capaian" class="block text-gray-700 font-bold mb-2">Capaian</label>
                    <select name="capaian" id="capaian"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        <option value="Belum Berkembang" {{ $laporan->capaian == 'Belum Berkembang' ? 'selected' : '' }}>
                            Belum Berkembang</option>
                        <option value="Mulai Berkembang" {{ $laporan->capaian == 'Mulai Berkembang' ? 'selected' : '' }}>
                            Mulai Berkembang</option>
                        <option value="Berkembang Sesuai Harapan"
                            {{ $laporan->capaian == 'Berkembang Sesuai Harapan' ? 'selected' : '' }}>Berkembang Sesuai
                            Harapan</option>
                        <option value="Berkembang Sangat Baik"
                            {{ $laporan->capaian == 'Berkembang Sangat Baik' ? 'selected' : '' }}>Berkembang Sangat Baik
                        </option>
                    </select>
                </div>

                {{-- Catatan Guru --}}
                <div class="mb-6">
                    <label for="catatan_guru" class="block text-gray-700 font-bold mb-2">Catatan Guru (Opsional)</label>
                    <textarea name="catatan_guru" id="catatan_guru" rows="4"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('catatan_guru', $laporan->catatan_guru) }}</textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Perbarui Laporan
                    </button>
                    <a href="{{ route('guru.siswa.show', $siswa->id_siswa) }}"
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
