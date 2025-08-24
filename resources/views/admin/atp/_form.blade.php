@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Tahun Ajaran --}}
    <div>
        <label for="tahun_ajaran" class="block text-gray-700 font-bold mb-2">Tahun Ajaran</label>
        <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('tahun_ajaran', $atp->tahun_ajaran ?? '') }}" placeholder="Contoh: 2025/2026" required>
    </div>

    {{-- Semester --}}
    <div>
        <label for="semester" class="block text-gray-700 font-bold mb-2">Semester</label>
        <select name="semester" id="semester" class="shadow border rounded w-full py-2 px-3" required>
            <option value="Ganjil" {{ old('semester', $atp->semester ?? '') == 'Ganjil' ? 'selected' : '' }}>Ganjil
            </option>
            <option value="Genap" {{ old('semester', $atp->semester ?? '') == 'Genap' ? 'selected' : '' }}>Genap
            </option>
        </select>
    </div>

    {{-- Fase Perkembangan --}}
    <div class="md:col-span-2">
        <label for="fase_perkembangan" class="block text-gray-700 font-bold mb-2">Fase Perkembangan</label>
        <input type="text" name="fase_perkembangan" id="fase_perkembangan"
            class="shadow border rounded w-full py-2 px-3"
            value="{{ old('fase_perkembangan', $atp->fase_perkembangan ?? 'Fase Fondasi Usia 5-6 Tahun') }}" required>
    </div>

    {{-- Elemen Kurikulum --}}
    <div>
        <label for="elemen_kurikulum" class="block text-gray-700 font-bold mb-2">Elemen Kurikulum</label>
        <input type="text" name="elemen_kurikulum" id="elemen_kurikulum"
            class="shadow border rounded w-full py-2 px-3"
            value="{{ old('elemen_kurikulum', $atp->elemen_kurikulum ?? '') }}" placeholder="Contoh: Jati Diri"
            required>
    </div>

    {{-- Urutan --}}
    <div>
        <label for="urutan" class="block text-gray-700 font-bold mb-2">Nomor Urut</label>
        <input type="number" name="urutan" id="urutan" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('urutan', $atp->urutan ?? '0') }}">
    </div>

    {{-- Tujuan Pembelajaran --}}
    <div class="md:col-span-2">
        <label for="tujuan_pembelajaran" class="block text-gray-700 font-bold mb-2">Tujuan Pembelajaran</label>
        <textarea name="tujuan_pembelajaran" id="tujuan_pembelajaran" rows="4"
            class="shadow border rounded w-full py-2 px-3">{{ old('tujuan_pembelajaran', $atp->tujuan_pembelajaran ?? '') }}</textarea>
    </div>
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.atp.index') }}" class="text-sm text-gray-600 hover:text-gray-800 mr-4">Batal</a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ isset($atp->id_atp) ? 'Perbarui Tujuan' : 'Simpan Tujuan' }}
    </button>
</div>
