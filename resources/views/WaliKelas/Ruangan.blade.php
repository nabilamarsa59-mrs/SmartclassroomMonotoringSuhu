<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartClassroom - Ruangan</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
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
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8faf8] text-slate-800 antialiased min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-sage-100 flex flex-col justify-between hidden md:flex shrink-0 min-h-screen">
        <div>
            <!-- Header Brand -->
            <div class="p-6 flex items-center gap-3 border-b border-sage-100">
                <div class="w-10 h-10 rounded-xl bg-sage-100 flex items-center justify-center text-sage-600 font-bold">
                    <i data-lucide="thermometer" class="w-6 h-6"></i>
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

        <!-- Logout Button -->
        <div class="p-4 border-t border-sage-100">
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl transition">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span>Keluar</span>
            </a>
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
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Ruangan</h2>
                    <p class="text-xs text-slate-500">Pantau kondisi setiap ruang kelas</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <button class="relative p-2.5 bg-sage-50 text-slate-600 hover:text-sage-700 rounded-xl border border-sage-100 transition">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-amber-500 rounded-full ring-2 ring-white"></span>
                </button>
            </div>
        </header>

        <!-- MAIN CONTAINER -->
        <main class="p-6 md:p-8 flex-1 overflow-y-auto space-y-6 max-w-7xl">
            
            <!-- SEARCH AND FILTER BAR -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                
                <!-- Search Input -->
                <div class="relative flex-1 max-w-md">
                    <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    <input 
                        type="text" 
                        id="searchInput"
                        onkeyup="filterRooms()"
                        placeholder="Cari ruangan..." 
                        class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-sage-600 focus:border-transparent transition shadow-sm placeholder-slate-400"
                    >
                </div>

                <!-- Filter Category Pills -->
                <div class="flex items-center gap-2">
                    <button 
                        onclick="setFilter('all')" 
                        id="btn-filter-all"
                        class="filter-btn px-5 py-2 rounded-xl text-sm font-semibold transition bg-sage-600 text-white shadow-sm"
                    >
                        Semua
                    </button>
                    <button 
                        onclick="setFilter('normal')" 
                        id="btn-filter-normal"
                        class="filter-btn px-5 py-2 rounded-xl text-sm font-semibold transition bg-white text-slate-600 hover:bg-slate-50 border border-slate-200"
                    >
                        Normal
                    </button>
                    <button 
                        onclick="setFilter('warning')" 
                        id="btn-filter-warning"
                        class="filter-btn px-5 py-2 rounded-xl text-sm font-semibold transition bg-white text-slate-600 hover:bg-slate-50 border border-slate-200"
                    >
                        Peringatan
                    </button>
                </div>
            </div>

            <!-- ROOM CARDS GRID -->
            <div id="roomGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                
                <!-- Room 1A -->
                <div class="room-card bg-white border border-slate-100 p-5 rounded-2xl flex items-center justify-between shadow-sm hover:border-sage-200 transition cursor-pointer group" data-status="normal" data-name="ruang kelas 1a">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border-2 border-sage-600 bg-sage-50 text-sage-600 flex items-center justify-center shrink-0">
                            <i data-lucide="thermometer" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 text-base">Ruang Kelas 1A</h5>
                            <p class="text-xs text-slate-400 font-medium">Lantai 1 • Sensor aktif</p>
                            <p class="text-xs text-slate-600 font-semibold mt-1">25,8°C <span class="text-slate-300 font-normal">|</span> 62% kelembapan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-semibold bg-sage-100 text-sage-800 px-3 py-1 rounded-full">Normal</span>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                    </div>
                </div>

                <!-- Room 1B -->
                <div class="room-card bg-white border border-slate-100 p-5 rounded-2xl flex items-center justify-between shadow-sm hover:border-sage-200 transition cursor-pointer group" data-status="normal" data-name="ruang kelas 1b">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border-2 border-sage-600 bg-sage-50 text-sage-600 flex items-center justify-center shrink-0">
                            <i data-lucide="thermometer" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 text-base">Ruang Kelas 1B</h5>
                            <p class="text-xs text-slate-400 font-medium">Lantai 1 • Sensor aktif</p>
                            <p class="text-xs text-slate-600 font-semibold mt-1">27,2°C <span class="text-slate-300 font-normal">|</span> 58% kelembapan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-semibold bg-sage-100 text-sage-800 px-3 py-1 rounded-full">Normal</span>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                    </div>
                </div>

                <!-- Room 2A (Peringatan) -->
                <div class="room-card bg-white border border-amber-200/80 p-5 rounded-2xl flex items-center justify-between shadow-sm hover:border-amber-300 transition cursor-pointer group" data-status="warning" data-name="ruang kelas 2a">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border-2 border-amber-600 bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <i data-lucide="thermometer-sun" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 text-base">Ruang Kelas 2A</h5>
                            <p class="text-xs text-slate-400 font-medium">Lantai 2 • Sensor aktif</p>
                            <p class="text-xs text-amber-700 font-semibold mt-1">29,4°C <span class="text-slate-300 font-normal">|</span> 65% kelembapan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-semibold bg-amber-100 text-amber-800 px-3 py-1 rounded-full">Peringatan</span>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                    </div>
                </div>

                <!-- Room 2B -->
                <div class="room-card bg-white border border-slate-100 p-5 rounded-2xl flex items-center justify-between shadow-sm hover:border-sage-200 transition cursor-pointer group" data-status="normal" data-name="ruang kelas 2b">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border-2 border-sage-600 bg-sage-50 text-sage-600 flex items-center justify-center shrink-0">
                            <i data-lucide="thermometer" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 text-base">Ruang Kelas 2B</h5>
                            <p class="text-xs text-slate-400 font-medium">Lantai 2 • Sensor aktif</p>
                            <p class="text-xs text-slate-600 font-semibold mt-1">24,1°C <span class="text-slate-300 font-normal">|</span> 60% kelembapan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-semibold bg-sage-100 text-sage-800 px-3 py-1 rounded-full">Normal</span>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                    </div>
                </div>

                <!-- Room 3A -->
                <div class="room-card bg-white border border-slate-100 p-5 rounded-2xl flex items-center justify-between shadow-sm hover:border-sage-200 transition cursor-pointer group" data-status="normal" data-name="ruang kelas 3a">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border-2 border-sage-600 bg-sage-50 text-sage-600 flex items-center justify-center shrink-0">
                            <i data-lucide="thermometer" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 text-base">Ruang Kelas 3A</h5>
                            <p class="text-xs text-slate-400 font-medium">Lantai 3 • Sensor aktif</p>
                            <p class="text-xs text-slate-600 font-semibold mt-1">26,0°C <span class="text-slate-300 font-normal">|</span> 61% kelembapan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-semibold bg-sage-100 text-sage-800 px-3 py-1 rounded-full">Normal</span>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                    </div>
                </div>

                <!-- Lab Komputer (Peringatan) -->
                <div class="room-card bg-white border border-amber-200/80 p-5 rounded-2xl flex items-center justify-between shadow-sm hover:border-amber-300 transition cursor-pointer group" data-status="warning" data-name="lab komputer">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full border-2 border-amber-600 bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <i data-lucide="thermometer-sun" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 text-base">Lab Komputer</h5>
                            <p class="text-xs text-slate-400 font-medium">Lantai 2 • Sensor aktif</p>
                            <p class="text-xs text-amber-700 font-semibold mt-1">28,8°C <span class="text-slate-300 font-normal">|</span> 70% kelembapan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-semibold bg-amber-100 text-amber-800 px-3 py-1 rounded-full">Peringatan</span>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                    </div>
                </div>

            </div>

            <!-- SUMMARY METRICS BOX (RINGKASAN) -->
            <div class="pt-6">
                <h4 class="text-base font-bold text-slate-800 mb-3">Ringkasan</h4>
                <div class="grid grid-cols-3 gap-4 max-w-2xl">
                    
                    <!-- Total Ruangan -->
                    <div class="bg-white border border-slate-200 p-4 rounded-2xl text-center shadow-sm">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">RUANGAN</p>
                        <p class="text-2xl font-extrabold text-slate-900 mt-1">12</p>
                    </div>

                    <!-- Normal -->
                    <div class="bg-white border border-slate-200 p-4 rounded-2xl text-center shadow-sm">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">NORMAL</p>
                        <p class="text-2xl font-extrabold text-slate-900 mt-1">10</p>
                    </div>

                    <!-- Peringatan -->
                    <div class="bg-white border border-slate-200 p-4 rounded-2xl text-center shadow-sm">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">PERINGATAN</p>
                        <p class="text-2xl font-extrabold text-slate-900 mt-1">2</p>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <!-- JavaScript Logic for Filtering & Search -->
    <script>
        lucide.createIcons();

        let currentFilter = 'all';

        function setFilter(filterType) {
            currentFilter = filterType;

            // Update Active Pill Styles
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.className = 'filter-btn px-5 py-2 rounded-xl text-sm font-semibold transition bg-white text-slate-600 hover:bg-slate-50 border border-slate-200';
            });

            const activeBtn = document.getElementById(`btn-filter-${filterType}`);
            if (activeBtn) {
                activeBtn.className = 'filter-btn px-5 py-2 rounded-xl text-sm font-semibold transition bg-sage-600 text-white shadow-sm';
            }

            filterRooms();
        }

        function filterRooms() {
            const query = document.getElementById('searchInput').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.room-card');

            cards.forEach(card => {
                const roomName = card.getAttribute('data-name');
                const roomStatus = card.getAttribute('data-status');

                const matchesSearch = roomName.includes(query);
                const matchesFilter = (currentFilter === 'all') || (roomStatus === currentFilter);

                if (matchesSearch && matchesFilter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>