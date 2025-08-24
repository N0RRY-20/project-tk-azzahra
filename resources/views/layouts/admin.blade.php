<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard {{ Auth::user()->peran }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 font-sans antialiased">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
            class="fixed inset-0 z-30 bg-black bg-opacity-50 lg:hidden">
        </div>

        <!-- Sidebar -->
        <aside :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-800 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 flex flex-col">

            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 bg-gray-900">
                <h2 class="text-xl font-bold text-white tracking-wide">TK Ceria</h2>
                <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto min-h-0"
                style="scrollbar-width: thin; scrollbar-color: #4B5563 #374151;">
                <style>
                    nav::-webkit-scrollbar {
                        width: 6px;
                    }

                    nav::-webkit-scrollbar-track {
                        background: #374151;
                        border-radius: 3px;
                    }

                    nav::-webkit-scrollbar-thumb {
                        background: #6B7280;
                        border-radius: 3px;
                    }

                    nav::-webkit-scrollbar-thumb:hover {
                        background: #9CA3AF;
                    }
                </style>
                @if (Auth::user()->peran === 'admin')
                    <!-- Dashboard Link -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Management Section -->
                    <div class="pt-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wide">Manajemen</p>
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('admin.guru.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.guru.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Manajemen Guru
                            </a>

                            <a href="{{ route('admin.siswa.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.siswa.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                    </path>
                                </svg>
                                Manajemen Siswa
                            </a>

                            <a href="{{ route('admin.kelas.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.kelas.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Manajemen Kelas
                            </a>

                            <a href="{{ route('admin.aspekPenilaian.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.aspekPenilaian.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Aspek Penilaian
                            </a>

                            <a href="{{ route('admin.jadwal-kegiatan.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.jadwal-kegiatan.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Manajemen Jadwal
                            </a>
                        </div>
                    </div>

                    <!-- Reports Section -->
                    <div class="pt-6">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wide">Rekapitulasi</p>
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('admin.absensi.siswa') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.absensi.siswa') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                Absensi Siswa
                            </a>

                            <a href="{{ route('admin.absensi-guru.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.absensi-guru.index') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                                Absensi Guru
                            </a>

                            <a href="{{ route('admin.pengumuman.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.pengumuman.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                    </path>
                                </svg>
                                Pengumuman
                            </a>

                            <a href="{{ route('admin.events.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.events.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v13m0-13V6a2 2 0 112 0v1.3l6 2.3c.5.2.8.7.8 1.2v8.2c0 .5-.3 1-.8 1.2l-6 2.3V21a2 2 0 11-2 0v-.8l-6-2.3c-.5-.2-.8-.7-.8-1.2V8.8c0-.5.3-1 .8-1.2l6-2.3V6a2 2 0 012-2z">
                                    </path>
                                </svg>
                                Event & Lomba
                            </a>

                            <a href="{{ route('admin.tagihan.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.tagihan.*') || request()->routeIs('admin.pembayaran.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                Keuangan
                            </a>

                            <div class="mt-4">
                                <p class="px-4 text-xs text-gray-400 uppercase">Laporan Akhir</p>
                                <a href="{{ route('admin.raport.create') }}"
                                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.raport.create') || request()->routeIs('admin.raport.create') ? 'bg-gray-700 text-white' : '' }}">
                                    Cetak Raport PDF
                                </a>
                            </div>
                            <a href="{{ route('admin.atp.index') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.atp.*') ? 'bg-gray-700 text-white' : '' }}">
                                {{-- Ikon ATP --}}
                                Manajemen ATP
                            </a>

                            <a href="{{ route('admin.supervisi-rpp.index') }}"
                                class="flex items-center px-4 py-2.5 ... {{ request()->routeIs('admin.supervisi-rpp.*') ? 'bg-gray-700 text-white' : '' }}">
                                {{-- Ikon --}}
                                Supervisi RPP
                            </a>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->peran === 'guru')
                    <!-- Teacher Dashboard -->
                    <a href="{{ route('guru.dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('guru.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('guru.absensi.index') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('guru.absensi.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                        Absensi Harian
                    </a>

                    <a href="{{ route('guru.rppm.index') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('guru.rppm.*') || request()->routeIs('guru.rpph.*') ? 'bg-gray-700 text-white' : '' }}">
                        {{-- Ikon RPP --}}
                        Manajemen RPP
                    </a>
                    <a href="{{ route('guru.atp.index') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('guru.atp.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L20 12l-5.447 2.724A1 1 0 0114 13.618V12M14 20l-5.447-2.724A1 1 0 018 16.382V5.618a1 1 0 011.447-.894L15 6m-1 8v5m0-5l4-2">
                            </path>
                        </svg>
                        Lihat ATP
                    </a>
                @endif

                @if (Auth::user()->peran === 'orangtua')
                    <a href="{{ route('orangtua.dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('orangtua.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                @endif

                <!-- Common Links -->
                <div class="pt-4">
                    <a href="{{ route('events.index') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200 {{ request()->routeIs('events.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 0v1.3l6 2.3c.5.2.8.7.8 1.2v8.2c0 .5-.3 1-.8 1.2l-6 2.3V21a2 2 0 11-2 0v-.8l-6-2.3c-.5-.2-.8-.7-.8-1.2V8.8c0-.5.3-1 .8-1.2l6-2.3V6a2 2 0 012-2z">
                            </path>
                        </svg>
                        Event & Lomba
                    </a>
                </div>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <!-- Mobile Menu Button -->
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true"
                            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600 lg:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Page Title -->
                    <div class="flex-1 min-w-0 px-4 lg:px-0">
                        <h1 class="text-lg font-semibold text-gray-900 sm:text-xl md:text-2xl lg:text-3xl">
                            Dashboard Adminnnn
                        </h1>
                    </div>

                    <!-- User Welcome -->
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center space-x-2 focus:outline-none">
                            <div class="hidden md:block">
                                <p class="text-sm text-gray-700">
                                    Selamat datang, <span class="font-medium">{{ Auth::user()->username }}</span>!
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </button>

                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">

                            <a href="{{ route('profil.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile User Info -->
                <div class="px-4 pb-4 md:hidden">
                    <p class="text-sm text-gray-700">
                        Selamat datang, <span class="font-medium">{{ Auth::user()->username }}</span>!
                    </p>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-4 py-6 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>

</html>
