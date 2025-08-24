@csrf
<input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Tahun Ajaran --}}
    <div>
        <label for="tahun_ajaran" class="block text-gray-700 font-bold mb-2">Tahun Ajaran</label>
        <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('tahun_ajaran', $rppm->tahun_ajaran ?? '') }}" placeholder="Contoh: 2025/2026" required>
    </div>

    {{-- Semester --}}
    <div>
        <label for="semester" class="block text-gray-700 font-bold mb-2">Semester</label>
        <select name="semester" id="semester" class="shadow border rounded w-full py-2 px-3" required>
            <option value="Ganjil" {{ old('semester', $rppm->semester ?? '') == 'Ganjil' ? 'selected' : '' }}>Ganjil
            </option>
            <option value="Genap" {{ old('semester', $rppm->semester ?? '') == 'Genap' ? 'selected' : '' }}>Genap
            </option>
        </select>
    </div>
    {{-- Bulan --}}
    <div>
        <label for="bulan" class="block text-gray-700 font-bold mb-2">Bulan</label>
        <select name="bulan" id="bulan" class="shadow border rounded w-full py-2 px-3" required>
            @php
                // Buat array nama bulan dalam Bahasa Indonesia
                $daftarBulan = [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ];
            @endphp
            @foreach ($daftarBulan as $bulan)
                <option value="{{ $bulan }}" {{ old('bulan', $rppm->bulan ?? '') == $bulan ? 'selected' : '' }}>
                    {{ $bulan }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Minggu Ke --}}
    <div>
        <label for="minggu_ke" class="block text-gray-700 font-bold mb-2">Minggu Ke-</label>
        <select name="minggu_ke" id="minggu_ke" class="shadow border rounded w-full py-2 px-3" required>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}"
                    {{ old('minggu_ke', $rppm->minggu_ke ?? '') == $i ? 'selected' : '' }}>
                    Minggu ke-{{ $i }}
                </option>
            @endfor
        </select>
    </div>


    {{-- Tema --}}
    <div class="md:col-span-2">
        <label for="tema" class="block text-gray-700 font-bold mb-2">Tema</label>
        <input type="text" name="tema" id="tema" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('tema', $rppm->tema ?? '') }}" required>
    </div>

    {{-- Sub Tema --}}
    <div class="md:col-span-2">
        <label for="sub_tema" class="block text-gray-700 font-bold mb-2">Sub-Tema</label>
        <input type="text" name="sub_tema" id="sub_tema" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('sub_tema', $rppm->sub_tema ?? '') }}" required>
    </div>
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('guru.rppm.index') }}" class="text-sm text-gray-600 hover:text-gray-800 mr-4">Batal</a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ isset($rppm->id_rppm) ? 'Perbarui RPPM' : 'Simpan RPPM' }}
    </button>
</div>
