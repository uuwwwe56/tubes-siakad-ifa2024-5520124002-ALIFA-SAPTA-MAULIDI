<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>@yield('title') - SCHOOLINK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #818cf8;
        }

        /* Smooth transitions */
        * {
            transition: all 0.2s ease-in-out;
        }

        /* Hover effects for cards */
        .stats-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Sidebar navigation animation */
        .nav-item {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(to bottom, #6366f1, #8b5cf6);
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }

        .nav-item.active::before {
            transform: scaleY(1);
        }

        .nav-item:hover:not(.active) {
            transform: translateX(4px);
        }

        /* Loading animation */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }

        /* Notification badge pulse */
        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        .notification-badge {
            position: relative;
        }

        .notification-badge.has-notif::after {
            content: '';
            position: absolute;
            top: -2px;
            right: -2px;
            width: 10px;
            height: 10px;
            background-color: #ef4444;
            border-radius: 50%;
            border: 2px solid white;
            animation: pulse-ring 1.5s infinite;
        }

        /* Glassmorphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Mobile responsive adjustments */
        @media (max-width: 640px) {
            .stats-card {
                padding: 0.75rem;
            }

            .stats-card i {
                font-size: 1.25rem;
            }

            .stats-card h3 {
                font-size: 1.25rem;
            }

            .stats-card p {
                font-size: 0.7rem;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .dark-mode-aware {
                background-color: #1e293b;
            }
        }

        /* Tooltip styles */
        .tooltip {
            position: relative;
        }

        .tooltip::before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 4px 8px;
            background-color: #1e293b;
            color: white;
            font-size: 10px;
            border-radius: 6px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            margin-bottom: 8px;
        }

        .tooltip:hover::before {
            opacity: 1;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-indigo-50/30 antialiased"
    style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="flex min-h-screen overflow-hidden" x-data="{
        sidebarOpen: false,
        notificationsOpen: false,
        profileOpen: false
    }">

        {{-- Overlay for mobile --}}
        <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm md:hidden" x-cloak></div>

        {{-- ================= SIDEBAR MODERN ================= --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 text-white transition-all duration-300 ease-in-out md:static md:translate-x-0 flex flex-col shadow-2xl border-r border-white/10">

            <div class="flex flex-col h-full">

                {{-- Brand with animation --}}
                <div class="h-20 flex items-center justify-center border-b border-white/10 shrink-0 px-4 group">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-900/50 shrink-0 transition-all duration-300 group-hover:scale-110 group-hover:rotate-6">
                            <i class="fas fa-school text-white text-lg"></i>
                        </div>
                        <div class="text-left">
                            <h1 class="text-xl font-extrabold text-white tracking-wider leading-tight">
                                SCHOOL<span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">INK</span>
                            </h1>
                            <p class="text-[10px] text-slate-400 tracking-wide">SIAKAD Sekolah Modern</p>
                        </div>
                    </div>
                </div>


                <nav class="mt-6 px-3 space-y-1 overflow-y-auto flex-1 custom-scroll">
                    @auth
                        @if (Auth::user()->role === 'admin')
                            {{-- MENU ADMIN --}}
                            <div class="px-3 pb-2 pt-4">
                                <p
                                    class="text-[10px] font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-chart-line text-[10px]"></i> Menu Utama
                                </p>
                            </div>

                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-home mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Dashboard</span>
                                @if (request()->routeIs('admin.dashboard'))
                                    <i class="fas fa-circle text-[6px] text-indigo-400 ml-auto"></i>
                                @endif
                            </a>

                            <a href="{{ route('admin.dosen.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dosen.*') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-chalkboard-user mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Data Dosen</span>
                            </a>

                            <a href="{{ route('admin.mahasiswa.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.mahasiswa.*') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-user-graduate mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Data Siswa</span>
                            </a>

                            <a href="{{ route('admin.matakuliah.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.matakuliah.*') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-book-open mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Mata Pelajaran</span>
                            </a>

                            <a href="{{ route('admin.jadwal.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.jadwal.*') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-calendar-alt mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Jadwal Pelajaran</span>
                            </a>

                            <div class="px-3 pb-2 pt-6">
                                <p
                                    class="text-[10px] font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-user-circle text-[10px]"></i> Akun
                                </p>
                            </div>

                            <a href="{{ route('profile.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('profile.*') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-user-cog mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Profil Saya</span>
                            </a>
                             {{-- TOMBOL LOGOUT di dalam menu Akun --}}
                            <form action="{{ route('logout') }}" method="POST" class="px-3 mt-1">
                                @csrf
                                <button type="submit"
                                    class="w-full nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 text-rose-400 hover:bg-rose-600/20 hover:text-rose-300">
                                    <i
                                        class="fas fa-sign-out-alt mr-3 w-5 text-center text-lg group-hover:rotate-180 transition-transform duration-300"></i>
                                    <span class="font-medium text-sm">Keluar</span>
                                </button>
                            </form>
                        @elseif(Auth::user()->role === 'dosen')
                            {{-- MENU DOSEN --}}
                            <div class="px-3 pb-2 pt-4">
                                <p
                                    class="text-[10px] font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-chalkboard text-[10px]"></i> Kelas & Mengajar
                                </p>
                            </div>

                            <a href="{{ route('dosen.dashboard') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('dosen.dashboard') ? 'active bg-gradient-to-r from-emerald-600/20 to-teal-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-home mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Dashboard</span>
                            </a>

                            <a href="{{ route('dosen.krs.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('dosen.krs.*') ? 'active bg-gradient-to-r from-emerald-600/20 to-teal-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-clipboard-list mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Persetujuan KRS</span>
                            </a>

                            <a href="{{ route('dosen.classroom.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('dosen.classroom.*') ? 'active bg-gradient-to-r from-emerald-600/20 to-teal-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-chalkboard-user mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Classroom</span>
                            </a>

                            <div class="px-3 pb-2 pt-6">
                                <p
                                    class="text-[10px] font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-user-circle text-[10px]"></i> Akun
                                </p>
                            </div>

                            <a href="{{ route('profile.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('profile.*') ? 'active bg-gradient-to-r from-emerald-600/20 to-teal-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-user-cog mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Profil Saya</span>
                            </a>
                             {{-- TOMBOL LOGOUT di dalam menu Akun --}}
                            <form action="{{ route('logout') }}" method="POST" class="px-3 mt-1">
                                @csrf
                                <button type="submit"
                                    class="w-full nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 text-rose-400 hover:bg-rose-600/20 hover:text-rose-300">
                                    <i
                                        class="fas fa-sign-out-alt mr-3 w-5 text-center text-lg group-hover:rotate-180 transition-transform duration-300"></i>
                                    <span class="font-medium text-sm">Keluar</span>
                                </button>
                            </form>
                        @elseif(Auth::user()->role === 'mahasiswa')
                            {{-- MENU MAHASISWA --}}
                            <div class="px-3 pb-2 pt-4">
                                <p
                                    class="text-[10px] font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-graduation-cap text-[10px]"></i> Akademik
                                </p>
                            </div>

                            <a href="{{ route('mahasiswa.dashboard') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.dashboard') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-home mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Dashboard</span>
                            </a>

                            <a href="{{ route('mahasiswa.krs.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.krs.*') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-file-signature mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Pengisian KRS</span>
                            </a>

                            <a href="{{ route('mahasiswa.classroom.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.classroom.*') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-calendar-alt mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Jadwal Saya</span>
                            </a>

                            <a href="#"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 text-slate-400 hover:bg-white/5 hover:text-white">
                                <i class="fas fa-chart-line mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Nilai & KHS</span>
                            </a>

                            {{-- MENU AKUN dengan Logout --}}
                            <div class="px-3 pb-2 pt-6">
                                <p
                                    class="text-[10px] font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-user-circle text-[10px]"></i> Akun
                                </p>
                            </div>

                            <a href="{{ route('profile.index') }}"
                                class="nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('profile.*') ? 'active bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas fa-user-cog mr-3 w-5 text-center text-lg"></i>
                                <span class="font-medium text-sm">Profil Saya</span>
                            </a>

                            {{-- TOMBOL LOGOUT di dalam menu Akun --}}
                            <form action="{{ route('logout') }}" method="POST" class="px-3 mt-1">
                                @csrf
                                <button type="submit"
                                    class="w-full nav-item group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 text-rose-400 hover:bg-rose-600/20 hover:text-rose-300">
                                    <i
                                        class="fas fa-sign-out-alt mr-3 w-5 text-center text-lg group-hover:rotate-180 transition-transform duration-300"></i>
                                    <span class="font-medium text-sm">Keluar</span>
                                </button>
                            </form>
                        @endif
                    @endauth

                    @guest
                        <div class="px-4 py-6 text-center">
                            <div class="p-4 bg-white/5 rounded-xl border border-white/10">
                                <i class="fas fa-lock text-3xl text-indigo-400 mb-3"></i>
                                <p class="text-sm text-slate-300 mb-3">Anda belum login</p>
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                                    <i class="fas fa-arrow-right-to-bracket"></i> Login Sekarang
                                </a>
                            </div>
                        </div>
                    @endguest
                </nav>


            </div>
        </aside>

        {{-- ================= MAIN CONTENT ================= --}}
        <div class="flex-1 flex flex-col min-w-0 bg-gradient-to-br from-slate-50 to-indigo-50/20">

            {{-- HEADER MODERN with glassmorphism --}}
            <header
                class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/50 flex items-center justify-between px-4 md:px-8 sticky top-0 z-30 shadow-sm">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="text-slate-500 focus:outline-none md:hidden p-2 rounded-lg hover:bg-slate-100 active:bg-slate-200 transition-all duration-200 hover:scale-105">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="hidden sm:block">
                        <h2
                            class="text-lg font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
                            @yield('title', 'Dashboard')
                        </h2>
                        <p class="text-[11px] text-slate-400">Sistem Informasi Akademik SCHOOLINK</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 md:gap-5">

                    {{-- Profile Dropdown Desktop --}}
                    {{-- Profile Dropdown Desktop --}}
                    <div class="relative">
                        <button @click="profileOpen = !profileOpen"
                            class="flex items-center gap-2 focus:outline-none group">
                            @auth
                                @php
                                    $currentUser = Auth::user();
                                    $displayProfileName =
                                        $currentUser->username ??
                                        ($currentUser->dosen->nama ?? ($currentUser->mahasiswa->nama ?? 'User'));
                                @endphp
                                <div class="text-right hidden sm:block">
                                    <p class="text-xs font-bold text-slate-700 leading-tight">
                                        {{ $displayProfileName }}
                                    </p>
                                    <p class="text-[10px] text-slate-400 capitalize font-medium leading-tight">
                                        {{ $currentUser->role }}
                                    </p>
                                </div>
                                <div
                                    class="w-9 h-9 rounded-full overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold shadow-md transition-all duration-300 group-hover:scale-105">
                                    @if ($currentUser->avatar)
                                        <img src="{{ asset('storage/' . $currentUser->avatar) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($displayProfileName, 0, 1)) }}
                                    @endif
                                </div>
                            @else
                                {{-- Tampilan untuk guest --}}
                                <div class="flex items-center gap-2">
                                    <div class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center">
                                        <i class="fas fa-user text-slate-500 text-sm"></i>
                                    </div>
                                </div>
                            @endauth
                        </button>

                        {{-- Dropdown Profile --}}
                        <div x-show="profileOpen" @click.away="profileOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute right-0 mt-3 w-64 bg-white rounded-xl shadow-2xl border border-slate-100 z-50 overflow-hidden"
                            style="display: none;">

                            @auth
                                @php
                                    $currentUser = Auth::user();
                                    $displayProfileName =
                                        $currentUser->username ??
                                        ($currentUser->dosen->nama ?? ($currentUser->mahasiswa->nama ?? 'User'));
                                @endphp
                                <div class="p-4 bg-gradient-to-r from-indigo-50 to-purple-50">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($displayProfileName, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">{{ $displayProfileName }}</p>
                                            <p class="text-[10px] text-indigo-600 capitalize">{{ $currentUser->role }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <a href="{{ route('profile.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition-colors">
                                        <i class="fas fa-user-circle w-4 text-slate-400"></i> Profil Saya
                                    </a>
                                    <a href="#"
                                        class="flex items-center gap-3 px-3 py-2 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition-colors">
                                        <i class="fas fa-cog w-4 text-slate-400"></i> Pengaturan
                                    </a>
                                    <hr class="my-2 border-slate-100">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-3 px-3 py-2 text-sm text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                            <i class="fas fa-sign-out-alt w-4"></i> Keluar
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="p-4 text-center">
                                    <i class="fas fa-user-circle text-4xl text-slate-300 mb-2"></i>
                                    <p class="text-sm text-slate-600">Anda belum login</p>
                                    <a href="{{ route('login') }}"
                                        class="mt-3 inline-block text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                                        Login Sekarang →
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            {{-- MAIN CONTENT AREA --}}
            <main class="flex-1 p-4 md:p-6 lg:p-8">
                @yield('content')
            </main>

            {{-- FOOTER MODERN --}}
            <footer class="bg-white/50 backdrop-blur-sm border-t border-slate-200/50 py-4 px-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-center">
                    <p class="text-[11px] text-slate-400 font-medium">
                        <i class="far fa-copyright mr-1"></i> {{ date('Y') }} SCHOOLINK - Sistem Informasi
                        Akademik Sekolah
                    </p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="text-[11px] text-slate-400 hover:text-indigo-600 transition-colors">Tentang</a>
                        <a href="#"
                            class="text-[11px] text-slate-400 hover:text-indigo-600 transition-colors">Bantuan</a>
                        <a href="#"
                            class="text-[11px] text-slate-400 hover:text-indigo-600 transition-colors">Kebijakan
                            Privasi</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- Additional script for tooltips --}}
    <script>
        // Close dropdowns on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (window.Alpine && window.Alpine.store) {
                    // This will be handled by Alpine's @click.away
                }
            }
        });

        // Add loading state to buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.classList.contains('btn-loading')) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.classList.add('btn-loading');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';

                    // Reset after 30 seconds (fallback)
                    setTimeout(() => {
                        if (submitBtn.disabled) {
                            submitBtn.classList.remove('btn-loading');
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        }
                    }, 30000);
                }
            });
        });
    </script>
</body>

</html>
