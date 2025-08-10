@csrf
{{-- Nama Lengkap --}}
<div class="mb-4">
    <label for="nama_lengkap" class="block text-gray-700 font-bold mb-2">Nama Lengkap Siswa</label>
    <input type="text" name="nama_lengkap" id="nama_lengkap" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nama_lengkap', $siswa->nama_lengkap ?? '') }}" required>
    @error('nama_lengkap')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
</div>

{{-- Tanggal Lahir --}}
<div class="mb-4">
    <label for="tanggal_lahir" class="block text-gray-700 font-bold mb-2">Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ?? '') }}">
    @error('tanggal_lahir')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
</div>

{{-- Telepon Orang Tua --}}
<div class="mb-4">
    <label for="telepon_orangtua" class="block text-gray-700 font-bold mb-2">Telepon Orang Tua (Opsional)</label>
    <input type="text" name="telepon_orangtua" id="telepon_orangtua" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ old('telepon_orangtua', $siswa->telepon_orangtua ?? '') }}">
    @error('telepon_orangtua')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
</div>

{{-- Pilihan Kelas --}}
<div class="mb-6">
    <label for="id_kelas" class="block text-gray-700 font-bold mb-2">Kelas</label>
    <select name="id_kelas" id="id_kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <option value="">Pilih Kelas</option>
        @foreach($kelasList as $kelas)
            <option value="{{ $kelas->id_kelas }}" {{ (isset($siswa) && $siswa->id_kelas == $kelas->id_kelas) || old('id_kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                {{ $kelas->nama_kelas }}
            </option>
        @endforeach
    </select>
    @error('id_kelas')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
</div>

@if (!$siswa->id_orangtua)
    <div class="mb-6">
        <label class="block text-gray-700 font-bold">
            <input type="checkbox" name="regenerate_code" class="mr-2 leading-tight">
            <span>Buat Ulang Kode Aktivasi</span>
        </label>
        <p class="text-gray-600 text-xs italic mt-2">Centang kotak ini jika orang tua kehilangan atau belum menerima kode aktivasi.</p>
    </div>
@endif

<div class="flex items-center justify-between">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        {{ isset($siswa) ? 'Perbarui' : 'Simpan' }}
    </button>
    <a href="{{ route('admin.siswa.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
        Batal
    </a>
</div>