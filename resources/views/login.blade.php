<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    @vite(['resources/css/app.css'])
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-lg">

        <h2 class="text-2xl font-bold text-center text-gray-800">Login</h2>
        {{-- alert error --}}
        @if (session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded-md text-sm mb-4">
                {{ session('error') }}
            </div>
        @endif


        {{-- Alert success --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-md text-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.check') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required
                    class="w-full px-4 py-2 mt-1 border rounded-md" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" />
            </div>

            <button type="submit"
                class="w-full py-2 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Login
            </button>
        </form>

        <p class="text-sm text-center text-gray-600">
            Orang Tua Murid?
            <a href="{{ route('aktivasi.create') }}" class="text-blue-600 hover:underline">Aktivasi Akun Anda</a>
        </p>
    </div>

</body>

</html>
