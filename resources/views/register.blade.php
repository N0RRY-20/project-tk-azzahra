<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800">Register</h2>

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300" />
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">No HP (WA)</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300" />
        @error('phone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" required class="w-full px-4 py-2 mt-1 border rounded-md" />
        @error('username')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password"  required class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300" />
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-300" />
        {{-- Tidak perlu @error karena `confirmed` error-nya muncul di password --}}
    </div>

    <button type="submit" class="w-full py-2 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
        Register
    </button>
</form>
        <p class="text-sm text-center text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
        </p>
    </div>

</body>
</html>
