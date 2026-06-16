<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Login - SCHOOLINK | SIAKAD Sekolah Modern</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Custom animation & micro-interactions */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }
        }

        @keyframes swing {

            0%,
            100% {
                transform: rotate(-5deg);
            }

            50% {
                transform: rotate(5deg);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse 2s ease-in-out infinite;
        }

        .animate-swing {
            animation: swing 4s ease-in-out infinite;
            transform-origin: top center;
        }

        .animate-bounce-slow {
            animation: bounce 2s ease-in-out infinite;
        }

        .btn-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            top: 50%;
            right: 20px;
            margin-top: -9px;
            border: 2px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Smooth input focus effect */
        .input-focus-ring:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.4);
            transform: scale(1.01);
        }

        /* Card hover effect with transition */
        .login-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (min-width: 768px) {
            .login-card:hover {
                transform: scale(1.01);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }
        }

        /* Feature item transition */
        .feature-item {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-item:hover {
            transform: translateY(-2px) scale(1.02);
            background-color: rgb(238, 242, 255);
            border-color: rgb(99, 102, 241);
        }

        /* Responsive illustration adjustments */
        @media (max-width: 640px) {
            .illustration-container svg {
                max-width: 280px;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-100 to-indigo-50 flex items-center justify-center min-h-screen p-3 sm:p-6">

    <div
        class="login-card bg-white w-full max-w-6xl rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2 min-h-[650px] transition-all duration-500">

        {{-- ================= LEFT PANEL : LOGIN FORM ================= --}}
        <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-900 text-white p-6 sm:p-8 lg:p-10 flex flex-col justify-center order-2 md:order-1 rounded-b-3xl md:rounded-b-none md:rounded-r-[50px] md:rounded-l-3xl animate-fade-in-up"
            style="animation-delay: 0.1s">

        
            {{-- Logo / Brand --}}
            <div class="flex items-center gap-3 mb-8 transition-transform hover:scale-105 duration-300">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-school text-xl"></i>
                </div>
                <div>
                    <span class="text-2xl font-extrabold tracking-wide">SCHOOLINK</span>
                    <p class="text-[11px] text-indigo-300 -mt-1">Sistem Informasi Akademik Sekolah</p>
                </div>
            </div>

            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight mb-2">
                Selamat Datang 👋
            </h2>

            <p class="text-sm text-slate-300 mb-8 leading-relaxed">
                Silakan masuk menggunakan akun SCHOOLINK Anda untuk mengakses jadwal, KRS, dan nilai rapor.
            </p>

            <form action="{{ route('login.store') }}" method="POST" id="loginForm" class="space-y-5">
                @csrf

                {{-- Username / NIS / NIK --}}
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                        <i class="fa-regular fa-user mr-1"></i> Username / NIS
                    </label>

                    <div class="relative group">
                        <i
                            class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-indigo-400 transition-all duration-200"></i>

                        <input type="text" name="username" value="{{ old('username') }}" autocomplete="username"
                            class="input-focus-ring w-full pl-11 pr-4 py-3.5 bg-white/10 border @error('username') border-rose-400 @else border-white/20 @enderror rounded-xl text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white/20 transition-all duration-200"
                            placeholder="Masukkan username atau NIS">
                    </div>

                    @error('username')
                        <p class="text-rose-400 text-xs mt-2 font-medium flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                        <i class="fa-solid fa-key mr-1"></i> Password
                    </label>

                    <div class="relative group">
                        <i
                            class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-indigo-400 transition-all duration-200"></i>

                        <input type="password" name="password" id="password" autocomplete="current-password"
                            class="input-focus-ring w-full pl-11 pr-11 py-3.5 bg-white/10 border @error('password') border-rose-400 @else border-white/20 @enderror rounded-xl text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white/20 transition-all duration-200"
                            placeholder="••••••••">

                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-indigo-300 transition-all duration-200">
                            <i class="fa-regular fa-eye text-sm" id="togglePasswordIcon"></i>
                        </button>
                    </div>

                    @error('password')
                        <p class="text-rose-400 text-xs mt-2 font-medium flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me & Lupa Password --}}
                <div class="flex items-center justify-between mt-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-white/30 bg-white/10 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 transition-all">
                        <span class="text-xs text-slate-300 group-hover:text-white transition-colors">Ingat saya</span>
                    </label>

                    <a href="{{ route('password.request') }}"
                        class="text-xs font-semibold text-indigo-300 hover:text-white transition-all duration-200 hover:underline">
                        Lupa Password?
                    </a>
                </div>

                {{-- Submit Button with loading state --}}
                <button type="submit" id="submitBtn"
                    class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-lg shadow-indigo-900/50 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-slate-900">
                    <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Masuk
                </button>
            </form>

            <p class="text-[10px] text-slate-500 text-center mt-6">
                <i class="fa-regular fa-copyright"></i> {{ date('Y') }} SCHOOLINK — SIAKAD Sekolah Terintegrasi
            </p>
        </div>

        {{-- ================= RIGHT PANEL : SIAKAD SEKOLAH ILLUSTRATION ================= --}}
        <div class="relative bg-gradient-to-br from-indigo-50 via-white to-purple-50 p-6 sm:p-8 lg:p-10 flex flex-col items-center justify-center order-1 md:order-2 animate-fade-in-up overflow-hidden"
            style="animation-delay: 0.2s">

            {{-- Decorative background elements --}}
            <div
                class="absolute top-0 right-0 w-56 h-56 bg-indigo-200 rounded-full blur-3xl opacity-30 transition-all duration-1000 hover:opacity-50">
            </div>
            <div
                class="absolute bottom-0 left-0 w-40 h-40 bg-purple-200 rounded-full blur-3xl opacity-30 transition-all duration-1000 hover:opacity-50">
            </div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-yellow-100 rounded-full blur-3xl opacity-20">
            </div>

            <div class="relative z-10 w-full flex flex-col items-center">

                {{-- Title --}}
                <div class="text-center mb-6">
                    <span
                        class="text-xs font-bold tracking-[0.2em] text-indigo-600 uppercase mb-2 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-school"></i> SISTEM INFORMASI AKADEMIK
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-2">
                        Sekolah Digital <br class="hidden sm:block">
                        <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Masa
                            Kini</span>
                    </h2>
                </div>

                {{-- SIAKAD SEKOLAH ILLUSTRATION --}}
                <div class="illustration-container w-full max-w-[340px] sm:max-w-[400px] mb-6 animate-float">
                    <svg viewBox="0 0 500 420" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                        <defs>
                            <linearGradient id="gradIndigo" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#6366f1;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#8b5cf6;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="gradGreen" x1="0%" y1="0%" x2="100%"
                                y2="100%">
                                <stop offset="0%" style="stop-color:#10b981;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#34d399;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="gradOrange" x1="0%" y1="0%" x2="100%"
                                y2="100%">
                                <stop offset="0%" style="stop-color:#f59e0b;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#fbbf24;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="gradPink" x1="0%" y1="0%" x2="100%"
                                y2="100%">
                                <stop offset="0%" style="stop-color:#ec4899;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#f472b6;stop-opacity:1" />
                            </linearGradient>
                        </defs>

                        <!-- Background circle decoration -->
                        <circle cx="250" cy="200" r="170" fill="#eef2ff" opacity="0.4" />
                        <circle cx="250" cy="200" r="130" fill="#e0e7ff" opacity="0.3" />

                        <!-- ===== GEDUNG SEKOLAH ===== -->
                        <rect x="180" y="240" width="140" height="100" rx="6" fill="#94a3b8" />
                        <rect x="180" y="240" width="140" height="25" rx="6" fill="#64748b" />
                        <!-- Atap sekolah -->
                        <polygon points="170,240 250,200 330,240" fill="#ef4444" />
                        <polygon points="175,240 250,205 325,240" fill="#dc2626" />
                        <!-- Bendera -->
                        <line x1="250" y1="200" x2="250" y2="170" stroke="#475569"
                            stroke-width="2" />
                        <rect x="250" y="170" width="20" height="12" rx="1" fill="#3b82f6" />

                        <!-- Jendela sekolah (3 baris) -->
                        <!-- Baris 1 -->
                        <rect x="195" y="255" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="220" y="255" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="245" y="255" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="270" y="255" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="295" y="255" width="18" height="20" rx="2" fill="#fef08a" />
                        <!-- Baris 2 -->
                        <rect x="195" y="285" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="220" y="285" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="245" y="285" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="270" y="285" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="295" y="285" width="18" height="20" rx="2" fill="#fef08a" />
                        <!-- Baris 3 -->
                        <rect x="195" y="315" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="220" y="315" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="245" y="315" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="270" y="315" width="18" height="20" rx="2" fill="#fef08a" />
                        <rect x="295" y="315" width="18" height="20" rx="2" fill="#fef08a" />

                        <!-- Pintu sekolah -->
                        <rect x="235" y="320" width="30" height="40" rx="3" fill="#78350f" />
                        <circle cx="258" cy="340" r="2" fill="#fbbf24" />

                        <!-- ===== SISWA DENGAN SERAGAM ===== -->
                        <!-- ================= SISWA 1 ================= -->
                        <g>
                            <!-- Kepala -->
                            <circle cx="130" cy="270" r="12" fill="#fcd34d" />

                            <!-- Mata -->
                            <circle cx="126" cy="268" r="1.5" fill="#1e293b" />
                            <circle cx="134" cy="268" r="1.5" fill="#1e293b" />

                            <!-- Senyum -->
                            <path d="M126 274 Q130 278 134 274" stroke="#1e293b" stroke-width="1.5" fill="none" />

                            <!-- Badan -->
                            <rect x="120" y="282" width="20" height="35" rx="4" fill="#1e293b" />

                            <!-- Baju -->
                            <rect x="118" y="280" width="24" height="8" rx="2" fill="#3b82f6" />

                            <!-- Tangan -->
                            <line x1="120" y1="290" x2="112" y2="300" stroke="#fcd34d"
                                stroke-width="3" stroke-linecap="round" />

                            <line x1="140" y1="290" x2="148" y2="300" stroke="#fcd34d"
                                stroke-width="3" stroke-linecap="round" />

                            <!-- Tas -->
                            <rect x="140" y="290" width="10" height="20" rx="3" fill="#ef4444" />
                            <line x1="142" y1="290" x2="142" y2="282" stroke="#ef4444"
                                stroke-width="2" />

                            <!-- Kaki -->
                            <line x1="128" y1="317" x2="125" y2="335" stroke="#1e293b"
                                stroke-width="3" stroke-linecap="round" />

                            <line x1="132" y1="317" x2="135" y2="335" stroke="#1e293b"
                                stroke-width="3" stroke-linecap="round" />

                            <!-- Sepatu -->
                            <ellipse cx="124" cy="336" rx="4" ry="2" fill="#111827" />
                            <ellipse cx="136" cy="336" rx="4" ry="2" fill="#111827" />
                        </g>

                        <!-- ================= SISWA 2 ================= -->
                        <g>
                            <!-- Kepala -->
                            <circle cx="370" cy="260" r="12" fill="#fcd34d" />

                            <!-- Mata -->
                            <circle cx="366" cy="258" r="1.5" fill="#1e293b" />
                            <circle cx="374" cy="258" r="1.5" fill="#1e293b" />

                            <!-- Senyum -->
                            <path d="M366 265 Q370 270 374 265" stroke="#1e293b" stroke-width="1.5" fill="none" />

                            <!-- Badan -->
                            <rect x="360" y="272" width="20" height="35" rx="4" fill="#dc2626" />

                            <!-- Kerah -->
                            <rect x="358" y="270" width="24" height="8" rx="2" fill="#1e293b" />

                            <!-- Tangan -->
                            <line x1="360" y1="285" x2="350" y2="295" stroke="#fcd34d"
                                stroke-width="3" stroke-linecap="round" />

                            <line x1="380" y1="285" x2="390" y2="295" stroke="#fcd34d"
                                stroke-width="3" stroke-linecap="round" />

                            <!-- Buku -->
                            <rect x="382" y="278" width="12" height="16" rx="2" fill="#10b981" />
                            <line x1="388" y1="278" x2="388" y2="294" stroke="#ffffff"
                                stroke-width="1" />

                            <!-- Kaki -->
                            <line x1="367" y1="307" x2="364" y2="330" stroke="#1e293b"
                                stroke-width="3" stroke-linecap="round" />

                            <line x1="373" y1="307" x2="376" y2="330" stroke="#1e293b"
                                stroke-width="3" stroke-linecap="round" />

                            <!-- Sepatu -->
                            <ellipse cx="363" cy="331" rx="4" ry="2" fill="#111827" />
                            <ellipse cx="377" cy="331" rx="4" ry="2" fill="#111827" />
                        </g>
                        <!-- ===== JAM DINDING & BEL SEKOLAH ===== -->
                        <!-- Bel sekolah -->
                        <path d="M430 150 Q440 130 450 150" stroke="#b45309" stroke-width="4" fill="none" />
                        <circle cx="440" cy="155" r="10" fill="#d97706" />
                        <rect x="438" y="165" width="4" height="15" fill="#78350f" />
                        <circle cx="440" cy="155" r="3" fill="#fef3c7" />
                        <!-- Pukulan bel -->
                        <circle cx="448" cy="150" r="4" fill="#92400e" class="animate-swing" />

                        <!-- Jam dinding -->
                        <circle cx="70" cy="180" r="22" fill="#f3f4f6" stroke="#d1d5db"
                            stroke-width="2" />
                        <circle cx="70" cy="180" r="2" fill="#374151" />
                        <line x1="70" y1="180" x2="70" y2="165" stroke="#374151"
                            stroke-width="2" stroke-linecap="round">
                            <animateTransform attributeName="transform" type="rotate" from="0 70 180"
                                to="360 70 180" dur="60s" repeatCount="indefinite" />
                        </line>
                        <line x1="70" y1="180" x2="82" y2="185" stroke="#374151"
                            stroke-width="1.5" stroke-linecap="round">
                            <animateTransform attributeName="transform" type="rotate" from="0 70 180"
                                to="360 70 180" dur="5s" repeatCount="indefinite" />
                        </line>

                        <!-- ===== BUKU, PENSIL, PENGGARIS ===== -->
                        <!-- Tumpukan buku -->
                        <rect x="60" y="300" width="45" height="10" rx="2" fill="#ef4444"
                            transform="rotate(-3 82 305)" />
                        <rect x="62" y="292" width="45" height="10" rx="2" fill="#3b82f6"
                            transform="rotate(2 84 297)" />
                        <rect x="58" y="284" width="45" height="10" rx="2" fill="#10b981"
                            transform="rotate(-1 80 289)" />
                        <rect x="60" y="276" width="45" height="10" rx="2" fill="#8b5cf6"
                            transform="rotate(1 82 281)" />

                        <!-- Pensil -->
                        <rect x="115" y="278" width="8" height="40" rx="2" fill="#fbbf24"
                            transform="rotate(15 119 298)" />
                        <polygon points="115,278 119,278 117,268" fill="#fcd34d" transform="rotate(15 117 273)" />
                        <polygon points="115,278 119,278 117,268" fill="#1e293b"
                            transform="rotate(15 117 273) scale(0.3) translate(80 180)" />

                        <!-- Penggaris -->
                        <rect x="320" y="340" width="50" height="8" rx="1" fill="#a5b4fc"
                            transform="rotate(-10 345 344)" />
                        <line x1="325" y1="340" x2="325" y2="348" stroke="#6366f1"
                            stroke-width="1" />
                        <line x1="332" y1="340" x2="332" y2="348" stroke="#6366f1"
                            stroke-width="1" />
                        <line x1="339" y1="340" x2="339" y2="348" stroke="#6366f1"
                            stroke-width="1" />
                        <line x1="346" y1="340" x2="346" y2="348" stroke="#6366f1"
                            stroke-width="1" />

                        <!-- ===== RAPOR NILAI ===== -->
                        <rect x="380" y="300" width="55" height="45" rx="4" fill="white"
                            stroke="#c7d2fe" stroke-width="2" />
                        <rect x="380" y="300" width="55" height="12" rx="4" fill="#6366f1" />
                        <text x="390" y="309" font-size="7" fill="white" font-weight="bold">RAPOR</text>

                        <!-- Nilai dalam rapor -->
                        <text x="388" y="325" font-size="6" fill="#374151">Matematika : 85</text>
                        <text x="388" y="333" font-size="6" fill="#374151">IPA : 90</text>
                        <text x="388" y="341" font-size="6" fill="#374151">B. Inggris : 88</text>

                        <!-- Bintang prestasi -->
                        <polygon
                            points="420,320 422,325 428,325 423,328 425,333 420,330 415,333 417,328 412,325 418,325"
                            fill="#fbbf24" class="animate-pulse-slow" />



                        <!-- Kapur dan penghapus -->
                        <rect x="328" y="140" width="20" height="5" rx="1" fill="#fef3c7" />
                        <rect x="325" y="155" width="15" height="8" rx="1" fill="#fbcfe8" />

                        <!-- ===== DECORATIVE STARS & SPARKLES ===== -->
                        <circle cx="50" cy="100" r="3" fill="#fbbf24" class="animate-pulse-slow" />
                        <circle cx="460" cy="90" r="2.5" fill="#fbbf24" class="animate-pulse-slow" />
                        <circle cx="310" cy="80" r="2" fill="#a78bfa" class="animate-pulse-slow" />
                        <circle cx="100" cy="220" r="2.5" fill="#60a5fa" class="animate-pulse-slow" />
                        <circle cx="420" cy="230" r="2" fill="#f472b6" class="animate-pulse-slow" />

                        <!-- Awan -->
                        <path d="M30 140 Q45 125 60 140 Q70 135 80 145 Q90 155 75 160 L35 160 Q20 160 25 150 Z"
                            fill="white" opacity="0.6" />
                        <path d="M410 100 Q425 85 440 100 Q450 95 460 105 Q470 115 455 120 L415 120 Q400 120 405 110 Z"
                            fill="white" opacity="0.6" />
                    </svg>
                </div>

                {{-- Feature Grid dengan efek transisi --}}
                <div class="grid grid-cols-2 gap-3 w-full max-w-sm mt-4">
                    <div
                        class="feature-item flex items-center gap-2 text-xs text-slate-700 bg-white/80 rounded-xl px-3 py-2 shadow-sm border border-indigo-100 cursor-default transition-all duration-300">
                        <i class="fa-solid fa-receipt text-indigo-600"></i>
                        <span class="font-medium">KRS Online</span>
                    </div>
                    <div
                        class="feature-item flex items-center gap-2 text-xs text-slate-700 bg-white/80 rounded-xl px-3 py-2 shadow-sm border border-indigo-100 cursor-default transition-all duration-300">
                        <i class="fa-solid fa-calendar-check text-indigo-600"></i>
                        <span class="font-medium">Jadwal Pelajaran</span>
                    </div>
                    <div
                        class="feature-item flex items-center gap-2 text-xs text-slate-700 bg-white/80 rounded-xl px-3 py-2 shadow-sm border border-indigo-100 cursor-default transition-all duration-300">
                        <i class="fa-solid fa-chalkboard-user text-indigo-600"></i>
                        <span class="font-medium">Classroom Digital</span>
                    </div>
                    <div
                        class="feature-item flex items-center gap-2 text-xs text-slate-700 bg-white/80 rounded-xl px-3 py-2 shadow-sm border border-indigo-100 cursor-default transition-all duration-300">
                        <i class="fa-solid fa-file-alt text-indigo-600"></i>
                        <span class="font-medium">Nilai & Rapor</span>
                    </div>
                </div>

                <p class="text-xs text-slate-500 mt-6 max-w-xs text-center leading-relaxed">
                    🏫 Akses mudah jadwal pelajaran, cetak KRS, pantau nilai rapor,
                    dan raih prestasi terbaik bersama SCHOOLINK.
                </p>
            </div>
        </div>

    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        // Loading state on form submit
        document.getElementById('loginForm')?.addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            if (submitBtn) {
                submitBtn.classList.add('btn-loading');
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner mr-2"></i> Memproses...';
                submitBtn.disabled = true;
            }
        });

        // Auto-focus on first input
        document.querySelector('input[name="username"]')?.focus();
    </script>
</body>

</html>
