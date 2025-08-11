<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity md:hidden"></div>

        <div :class="{ 'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen }"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-800 text-white p-5 transform transition duration-300 md:relative md:translate-x-0 md:flex md:flex-col">
            <h2 class="text-2xl font-bold mb-10">TK Ceria</h2>
            <nav class="flex-1">
                @if (Auth::user()->peran === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Dashboard</a>
                    <div class="mt-4">
                        <p class="px-4 text-xs text-gray-400 uppercase">Manajemen</p>
                        <a href="{{ route('admin.guru.index') }}"
                            class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('admin.guru.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Manajemen
                            Guru</a>
                        <a href="{{ route('admin.siswa.index') }}"
                            class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('admin.siswa.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Manajemen
                            Siswa</a>
                        <a href="{{ route('admin.kelas.index') }}"
                            class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('admin.kelas.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Manajemen
                            Kelas</a>
                        <a href="{{ route('admin.aspekPenilaian.index') }}"
                            class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('admin.aspekPenilaian.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Manajemen
                            Aspek Penilaian</a>
                        {{-- <a href="{{ route('guru.laporan.create') }}" class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('guru.laporan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Laporan Perkembangan Anak</a> --}}
                        <a href="{{ route('admin.jadwal-kegiatan.index') }}"
                            class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('admin.jadwal-kegiatan.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Manajemen
                            Jadwal</a>
                    </div>
                    <div class="mt-4">
                        <p class="px-4 text-xs text-gray-400 uppercase">Rekapitulasi</p>
                        <a href="{{ route('admin.absensi.siswa') }}"
                            class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('admin.absensi.siswa') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Absensi
                            Siswa</a>
                        <a href="{{ route('admin.absensi-guru.index') }}"
                            class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('admin.absensi-guru.index') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Absensi
                            Guru</a>

                    </div>
                @endif
                @if (Auth::user()->peran === 'guru')
                    <a href="{{ route('guru.dashboard') }}"
                        class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('guru.dashboard.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Dashboard</a>
                    <a href="{{ route('guru.absensi.create') }}"
                        class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('guru.absensi.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Absensi
                        Harian</a>
                @endif
            </nav>
            </nav>
            <form method="POST" action="{{ route('logout') }}" class="mt-10">
                @csrf
                <button type="submit"
                    class="w-full text-left block py-2.5 px-4 rounded transition duration-200 hover:bg-red-700 bg-red-600">Logout</button>
            </form>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-6 bg-white border-b-2 border-gray-200">
                <button @click="sidebarOpen = true" class="md:hidden text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>

                <h1 class="text-xl md:text-3xl font-semibold text-gray-800">Dashboard Admin</h1>

                <div>Selamat datang, {{ Auth::user()->username }}!</div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>
