@csrf
{{-- Judul --}}
<div class="mb-4">
    <label for="judul" class="block text-gray-700 font-bold mb-2">Judul</label>
    <input type="text" name="judul" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3"
        value="{{ old('judul', $pengumuman->judul ?? '') }}" required>
</div>

{{-- Isi Pengumuman --}}
<div class="mb-4">
    <label for="isi" class="block text-gray-700 font-bold mb-2">Isi / Deskripsi</label>
    <textarea name="isi" id="isi" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3">{{ old('isi', $pengumuman->isi ?? '') }}</textarea>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Tipe --}}
    <div class="mb-4">
        <label for="tipe" class="block text-gray-700 font-bold mb-2">Tipe</label>
        <select name="tipe" id="tipe" class="shadow border rounded w-full py-2 px-3" required>
            <option value="Pengumuman" {{ old('tipe', $pengumuman->tipe ?? '') == 'Pengumuman' ? 'selected' : '' }}>
                Pengumuman</option>
            <option value="Event" {{ old('tipe', $pengumuman->tipe ?? '') == 'Event' ? 'selected' : '' }}>Event
            </option>
        </select>
    </div>

    {{-- Tanggal Event --}}
    <div class="mb-4">
        <label for="tanggal_event" class="block text-gray-700 font-bold mb-2">Tanggal Event (jika tipe Event)</label>
        <input type="date" name="tanggal_event" id="tanggal_event"
            class="shadow appearance-none border rounded w-full py-2 px-3"
            value="{{ old('tanggal_event', $pengumuman->tanggal_event ?? '') }}">
        @error('tanggal_event')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.pengumuman.index') }}" class="text-sm text-gray-600 hover:text-gray-800 mr-4">Batal</a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ isset($pengumuman->id_pengumuman) ? 'Perbarui' : 'Publikasikan' }}
    </button>
</div>
