@csrf
<div class="space-y-4">
    {{-- Nama Lomba --}}
    <div>
        <label for="nama_lomba" class="block text-gray-700 font-bold mb-2">Nama Lomba</label>
        <input type="text" name="nama_lomba" id="nama_lomba" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('nama_lomba', $lomba->nama_lomba ?? '') }}" required>
    </div>

    {{-- Keterangan --}}
    <div>
        <label for="keterangan" class="block text-gray-700 font-bold mb-2">Keterangan</label>
        <input type="text" name="keterangan" id="keterangan" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('keterangan', $lomba->keterangan ?? '') }}" placeholder="Contoh: 5 Orang khusus bundanya"
            required>
    </div>

    {{-- Kuota --}}
    <div>
        <label for="kuota" class="block text-gray-700 font-bold mb-2">Kuota Peserta</label>
        <input type="number" name="kuota" id="kuota" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('kuota', $lomba->kuota ?? '') }}" min="1" required>
    </div>
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.events.show', $lomba->id_event ?? $event->id_event) }}"
        class="text-sm text-gray-600 hover:text-gray-800 mr-4">Batal</a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ isset($lomba->id_lomba) ? 'Perbarui Lomba' : 'Simpan Lomba' }}
    </button>
</div>
