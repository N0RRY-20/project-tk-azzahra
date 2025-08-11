@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Pilihan Kelas --}}
    <div class="md:col-span-2">
        <label for="id_kelas" class="block text-gray-700 font-bold mb-2">Kelas</label>
        <select name="id_kelas" id="id_kelas" class="shadow border rounded w-full py-2 px-3" required>
            @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->id_kelas }}"
                    {{ old('id_kelas', $jadwal->id_kelas ?? '') == $kelas->id_kelas ? 'selected' : '' }}>
                    {{ $kelas->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Hari --}}
    <div>
        <label for="hari" class="block text-gray-700 font-bold mb-2">Hari</label>
        <select name="hari" id="hari" class="shadow border rounded w-full py-2 px-3" required>
            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                <option value="{{ $hari }}" {{ old('hari', $jadwal->hari ?? '') == $hari ? 'selected' : '' }}>
                    {{ $hari }}</option>
            @endforeach
        </select>
    </div>

    <div></div> {{-- Waktu Mulai --}}
    <div>
        <label for="waktu_mulai" class="block text-gray-700 font-bold mb-2">Waktu Mulai</label>
        <input type="time" name="waktu_mulai" id="waktu_mulai" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('waktu_mulai', isset($jadwal->waktu_mulai) ? date('H:i', strtotime($jadwal->waktu_mulai)) : '') }}"
            required>
    </div>

    {{-- Waktu Selesai --}}
    <div>
        <label for="waktu_selesai" class="block text-gray-700 font-bold mb-2">Waktu Selesai</label>
        <input type="time" name="waktu_selesai" id="waktu_selesai" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('waktu_selesai', isset($jadwal->waktu_selesai) ? date('H:i', strtotime($jadwal->waktu_selesai)) : '') }}"
            required>
    </div>

    {{-- Kegiatan --}}
    <div class="md:col-span-2">
        <label for="kegiatan" class="block text-gray-700 font-bold mb-2">Nama Kegiatan</label>
        <input type="text" name="kegiatan" id="kegiatan" class="shadow border rounded w-full py-2 px-3"
            value="{{ old('kegiatan', $jadwal->kegiatan ?? '') }}" required>
    </div>

    {{-- Keterangan --}}
    <div class="md:col-span-2">
        <label for="keterangan" class="block text-gray-700 font-bold mb-2">Keterangan (Opsional)</label>
        <textarea name="keterangan" id="keterangan" rows="3" class="shadow border rounded w-full py-2 px-3">{{ old('keterangan', $jadwal->keterangan ?? '') }}</textarea>
    </div>
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.jadwal-kegiatan.index') }}"
        class="text-sm text-gray-600 hover:text-gray-800 mr-4">Batal</a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ isset($jadwal) ? 'Perbarui Jadwal' : 'Simpan Jadwal' }}
    </button>
</div>
