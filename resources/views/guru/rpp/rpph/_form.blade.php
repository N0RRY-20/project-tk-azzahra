@csrf
<div class="space-y-4">
    {{-- Tanggal --}}
    <div>
        <label for="tanggal" class="block text-gray-700 font-bold mb-2">Tanggal Pelaksanaan</label>
        <input type="date" name="tanggal" id="tanggal" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('tanggal', $rpph->tanggal ?? date('Y-m-d')) }}" required>
    </div>

    {{-- Kegiatan Pembuka --}}
    <div>
        <label for="kegiatan_pembuka" class="block text-gray-700 font-bold mb-2">Kegiatan Pembuka</label>
        <textarea name="kegiatan_pembuka" id="kegiatan_pembuka" rows="3" class="shadow border rounded w-full py-2 px-3">{{ old('kegiatan_pembuka', $rpph->kegiatan_pembuka ?? '') }}</textarea>
    </div>

    {{-- Kegiatan Inti --}}
    <div>
        <label for="kegiatan_inti" class="block text-gray-700 font-bold mb-2">Kegiatan Inti</label>
        <textarea name="kegiatan_inti" id="kegiatan_inti" rows="5" class="shadow border rounded w-full py-2 px-3">{{ old('kegiatan_inti', $rpph->kegiatan_inti ?? '') }}</textarea>
    </div>

    {{-- Kegiatan Penutup --}}
    <div>
        <label for="kegiatan_penutup" class="block text-gray-700 font-bold mb-2">Kegiatan Penutup</label>
        <textarea name="kegiatan_penutup" id="kegiatan_penutup" rows="3" class="shadow border rounded w-full py-2 px-3">{{ old('kegiatan_penutup', $rpph->kegiatan_penutup ?? '') }}</textarea>
    </div>

    {{-- Alat dan Bahan --}}
    <div>
        <label for="alat_dan_bahan" class="block text-gray-700 font-bold mb-2">Alat dan Bahan</label>
        <textarea name="alat_dan_bahan" id="alat_dan_bahan" rows="3" class="shadow border rounded w-full py-2 px-3">{{ old('alat_dan_bahan', $rpph->alat_dan_bahan ?? '') }}</textarea>
    </div>
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('guru.rppm.show', $rpph->id_rppm ?? $rppm->id_rppm) }}"
        class="text-sm text-gray-600 hover:text-gray-800 mr-4">Batal</a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ isset($rpph->id_rpph) ? 'Perbarui RPPH' : 'Simpan RPPH' }}
    </button>
</div>
