<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aktivasi Akun Orang Tua</title>
    {{-- Copy paste style dari login.blade.php jika perlu --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center mb-6">Aktivasi Akun Orang Tua</h1>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('aktivasi.store') }}">
            @csrf
            <div class="mb-4">
                <label for="kode_aktivasi" class="block text-gray-700 font-bold mb-2">Kode Aktivasi</label>
                <input id="kode_aktivasi" type="text" name="kode_aktivasi" value="{{ old('kode_aktivasi') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kode_aktivasi') border-red-500 @enderror">
                @error('kode_aktivasi')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('username') border-red-500 @enderror">
                @error('username')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input id="password" type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                @error('password')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Aktivasi Akun</button>
        </form>
    </div>
</body>
</html>