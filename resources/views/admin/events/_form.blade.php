@csrf
<div class="space-y-4">
    {{-- Judul --}}
    <div>
        <label for="judul" class="block text-gray-700 font-bold mb-2">Judul Event</label>
        <input type="text" name="judul" id="judul"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
            value="{{ old('judul', $event->judul ?? '') }}" required>
        @error('judul')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tanggal Event --}}
    <div>
        <label for="tanggal_event" class="block text-gray-700 font-bold mb-2">Tanggal Event</label>
        <input type="date" name="tanggal_event" id="tanggal_event"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
            value="{{ old('tanggal_event', $event->tanggal_event ?? date('Y-m-d')) }}" required>
        @error('tanggal_event')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi (Opsional)</label>
        <textarea name="deskripsi" id="deskripsi" rows="4"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.events.index') }}" class="text-sm text-gray-600 hover:text-gray-800 mr-4">Batal</a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ isset($event->id_event) ? 'Perbarui Event' : 'Simpan Event' }}
    </button>
</div>
