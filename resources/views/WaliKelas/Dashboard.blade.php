<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartClassroom - Dashboard Monitoring Suhu</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sage: {
                            50: '#f4f7f4',
                            100: '#e3ebe3',
                            200: '#c8d8c8',
                            300: '#a3be9f',
                            500: '#52796f',
                            600: '#3a5a40',
                            700: '#2f4836',
                            800: '#23382b',
                            900: '#19281f',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#f8faf8] text-slate-800 font-sans antialiased min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-sage-100 flex flex-col justify-between hidden md:flex shrink-0">
        <div>
            <!-- Header Brand -->
            <div class="p-6 flex items-center gap-3 border-b border-sage-100">
                <div class="w-10 h-10 rounded-xl bg-sage-100 flex items-center justify-center text-sage-600">
                    <i data-lucide="thermometer"></i>
                </div>
                <div>
                    <h1 class="font-bold text-slate-800 text-base leading-tight">SmartClassroom</h1>
                    <p class="text-xs text-slate-500">Monitoring Suhu Ruangan</p>
                </div>
            </div>

            <!-- Profile Info -->
            <div class="p-4 mx-4 my-4 bg-sage-50 rounded-xl border border-sage-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-sage-200 flex items-center justify-center text-sage-700 font-semibold text-sm">
                    NB
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800">Bu Nabila</p>
                    <p class="text-xs text-slate-500">Guru</p>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="px-4 space-y-1">
                <a href="{{ route('walikelas.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm {{ request()->routeIs('walikelas.dashboard') ? 'font-semibold text-sage-700 bg-sage-100/80' : 'font-medium text-slate-600 hover:bg-sage-50 hover:text-sage-700' }} rounded-xl transition">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('walikelas.ruangan') }}" class="flex items-center gap-3 px-4 py-3 text-sm {{ request()->routeIs('walikelas.ruangan') ? 'font-semibold text-sage-700 bg-sage-100/80' : 'font-medium text-slate-600 hover:bg-sage-50 hover:text-sage-700' }} rounded-xl transition">
                    <i data-lucide="layout-grid" class="w-5 h-5"></i>
                    <span>Ruangan</span>
                </a>
                <a href="{{ route('walikelas.riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-sm {{ request()->routeIs('walikelas.riwayat') ? 'font-semibold text-sage-700 bg-sage-100/80' : 'font-medium text-slate-600 hover:bg-sage-50 hover:text-sage-700' }} rounded-xl transition">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                    <span>Riwayat</span>
                </a>
                <a href="{{ route('walikelas.pengaturan') }}" class="flex items-center gap-3 px-4 py-3 text-sm {{ request()->routeIs('walikelas.pengaturan') ? 'font-semibold text-sage-700 bg-sage-100/80' : 'font-medium text-slate-600 hover:bg-sage-50 hover:text-sage-700' }} rounded-xl transition">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    <span>Profil</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- TOP HEADER NAVBAR -->
        <header class="bg-white border-b border-sage-100 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600 hover:text-slate-900">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <h2 class="text-xl font-bold text-slate-800">Dashboard Utama</h2>
            </div>
            
            <div class="flex items-center gap-4">
                <button class="relative p-2.5 bg-sage-50 text-slate-600 hover:text-sage-700 rounded-xl border border-sage-100 transition">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                </button>
            </div>
        </header>

        <!-- DASHBOARD BODY -->
        <main class="p-6 md:p-8 flex-1 overflow-y-auto space-y-8">
            <!-- Greeting & Stats Section -->
            <div>
                <h3 class="text-2xl font-bold text-slate-800">Halo, Bu Nabila 👋</h3>
                <p class="text-slate-500 text-sm mt-1">Berikut ringkasan pemantauan suhu kelas hari ini.</p>
            </div>

            <!-- METRIC CARDS GRID -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card Suhu Rata-Rata -->
                <div class="bg-sage-50 border border-sage-200/60 p-6 rounded-2xl flex flex-col justify-between shadow-sm relative overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-sage-800">Suhu Rata-Rata Ruangan</span>
                        <div class="p-2.5 bg-white/80 rounded-xl text-sage-600 shadow-sm">
                            <i data-lucide="thermometer" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-extrabold text-slate-900">25,8°C</span>
                            <span class="text-xs font-medium bg-sage-200 text-sage-800 px-2.5 py-1 rounded-full flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-sage-600"></span> Normal
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">Rentang ideal: 22°C – 28°C</p>
                    </div>
                </div>

                <!-- Card Kelembapan -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl flex flex-col justify-between shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Kelembapan</span>
                        <div class="p-2.5 bg-slate-50 rounded-xl text-slate-600">
                            <i data-lucide="droplets" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-4xl font-extrabold text-slate-900">63%</span>
                        <p class="text-xs text-slate-500 mt-2">Dalam batas kelembapan optimal</p>
                    </div>
                </div>

                <!-- Card Suhu Tertinggi -->
                <div class="bg-white border border-slate-100 p-6 rounded-2xl flex flex-col justify-between shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Suhu Tertinggi</span>
                        <div class="p-2.5 bg-amber-50 rounded-xl text-amber-600">
                            <i data-lucide="sun" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-4xl font-extrabold text-slate-900">28,4°C</span>
                        <p class="text-xs text-slate-500 mt-2">Tercatat di Ruang Kelas 1B</p>
                    </div>
                </div>
            </div>

            <!-- LIST RUANGAN TERPANTAU -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="text-lg font-bold text-slate-800">Ruangan Terpantau</h4>
                    <a href="{{ route('walikelas.ruangan') }}" class="text-sm font-semibold text-sage-600 hover:text-sage-700">Lihat Semua</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Item 1 -->
                    <div class="bg-white border border-slate-100 p-5 rounded-2xl flex items-center justify-between shadow-sm hover:border-sage-200 transition cursor-pointer group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-sage-50 text-sage-600 flex items-center justify-center group-hover:bg-sage-100 transition">
                                <i data-lucide="thermometer" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 text-base">Ruang Kelas 1A</h5>
                                <p class="text-xs text-slate-500 mt-0.5">25,8°C • 62% Kelembapan</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-medium bg-sage-100 text-sage-700 px-3 py-1 rounded-full">Normal</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="bg-white border border-slate-100 p-5 rounded-2xl flex items-center justify-between shadow-sm hover:border-sage-200 transition cursor-pointer group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-sage-50 text-sage-600 flex items-center justify-center group-hover:bg-sage-100 transition">
                                <i data-lucide="thermometer" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 text-base">Ruang Kelas 1B</h5>
                                <p class="text-xs text-slate-500 mt-0.5">27,2°C • 58% Kelembapan</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-medium bg-sage-100 text-sage-700 px-3 py-1 rounded-full">Normal</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>