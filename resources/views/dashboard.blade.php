<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md text-center space-y-6">
        <h1 class="text-3xl font-bold text-gray-800">Selamat Datang di Dashboard</h1>
        <p class="text-gray-600">Anda telah berhasil login. Klik tombol di bawah ini untuk keluar dari sistem.</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                Logout
            </button>
        </form>
    </div>

</body>

</html>
