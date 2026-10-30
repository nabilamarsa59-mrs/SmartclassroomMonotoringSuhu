<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartClassroom - Riwayat & Analisis</title>
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
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <h2 class="text-xl font-bold text-slate-800">Riwayat & Analisis</h2>
                    <p class="text-xs text-slate-500">Data suhu dan analisis kondisi ruangan</p>
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
        <main class="p-6 md:p-8 flex-1 overflow-y-auto space-y-6 max-w-6xl">
            
            <!-- FILTER DROPDOWNS -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                <!-- Select Room -->
                <div class="relative min-w-[200px]">
                    <select id="roomSelect" onchange="updateDashboardData()" class="w-full appearance-none bg-white border border-slate-200 text-slate-700 py-3 pl-4 pr-10 rounded-2xl text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-sage-600 focus:border-transparent cursor-pointer shadow-sm">
                        <option value="1A">Ruang Kelas 1A</option>
                        <option value="1B">Ruang Kelas 1B</option>
                        <option value="2A">Ruang Kelas 2A</option>
                        <option value="Lab">Lab Komputer</option>
                    </select>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                </div>

                <!-- Select Time Filter -->
                <div class="relative min-w-[180px]">
                    <select id="timeSelect" onchange="updateDashboardData()" class="w-full appearance-none bg-white border border-slate-200 text-slate-700 py-3 pl-4 pr-10 rounded-2xl text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-sage-600 focus:border-transparent cursor-pointer shadow-sm">
                        <option value="today">Hari ini</option>
                        <option value="7days">7 Hari Terakhir</option>
                        <option value="30days">30 Hari Terakhir</option>
                    </select>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                </div>
            </div>

            <!-- GRAFIK SUHU CARD -->
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-slate-800">Grafik Suhu</h3>
                    <span class="text-xs text-slate-400 font-medium flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-sage-600"></span> Suhu Ruangan (°C)
                    </span>
                </div>
                
                <div class="h-64 sm:h-80 w-full relative">
                    <canvas id="tempChart"></canvas>
                </div>
            </div>

            <!-- ANALISIS AI CARD -->
            <div class="bg-sage-50/80 border border-sage-200/60 p-6 rounded-2xl shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="p-3 bg-white text-sage-700 rounded-2xl border border-sage-200/50 shadow-sm shrink-0">
                        <i data-lucide="brain" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-800">Analisis AI</h4>
                        <p id="aiSummary" class="text-sm text-slate-600 mt-1 leading-relaxed">
                            Pola suhu terdeteksi stabil. Tidak ditemukan anomali signifikan.
                        </p>
                    </div>
                </div>

                <div id="aiBadge" class="inline-flex items-center gap-1.5 bg-sage-600 text-white font-semibold text-xs px-4 py-2 rounded-full shrink-0 shadow-sm">
                    <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                    <span>Status: Normal</span>
                </div>
            </div>

            <!-- RINGKASAN DATA (METRIC CARDS) -->
            <div class="space-y-3">
                <h4 class="text-base font-bold text-slate-800">Ringkasan Data</h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Card Rata-rata -->
                    <div class="bg-white border border-slate-200/80 p-5 rounded-2xl text-center shadow-sm">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">RATA-RATA</p>
                        <p id="statAvg" class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">25,6°C</p>
                    </div>

                    <!-- Card Tertinggi -->
                    <div class="bg-white border border-slate-200/80 p-5 rounded-2xl text-center shadow-sm">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">TERTINGGI</p>
                        <p id="statMax" class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">28,4°C</p>
                    </div>

                    <!-- Card Terendah -->
                    <div class="bg-white border border-slate-200/80 p-5 rounded-2xl text-center shadow-sm">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">TERENDAH</p>
                        <p id="statMin" class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">23,1°C</p>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- CHART & INTERACTIVE LOGIC -->
    <script>
        lucide.createIcons();

        // Chart configuration setup
        const ctx = document.getElementById('tempChart').getContext('2d');
        
        // Gradient background fill for Chart.js line
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(58, 90, 64, 0.2)');
        gradient.addColorStop(1, 'rgba(58, 90, 64, 0.0)');

        let tempChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00'],
                datasets: [{
                    label: 'Suhu (°C)',
                    data: [24.0, 25.1, 24.0, 27.5, 26.0, 28.2, 29.8],
                    borderColor: '#3a5a40',
                    borderWidth: 3,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#3a5a40',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#2f4836',
                        padding: 10,
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 13 },
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return `Suhu: ${context.parsed.y} °C`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#64748b', font: { size: 12 } }
                    },
                    y: {
                        min: 20,
                        max: 32,
                        ticks: {
                            stepSize: 4,
                            color: '#64748b',
                            font: { size: 12 },
                            callback: function(value) {
                                return value + '°C';
                            }
                        },
                        grid: { color: '#f1f5f9' }
                    }
                }
            }
        });

        // Mock data set for interactive selection
        const roomDatasets = {
            '1A': {
                avg: '25,6°C', max: '28,4°C', min: '23,1°C',
                chartData: [24.0, 25.1, 24.0, 27.5, 26.0, 28.2, 29.8],
                aiText: 'Pola suhu terdeteksi stabil. Tidak ditemukan anomali signifikan.',
                isNormal: true
            },
            '1B': {
                avg: '26,2°C', max: '28,9°C', min: '24,0°C',
                chartData: [24.5, 25.8, 26.1, 28.0, 27.2, 28.9, 27.5],
                aiText: 'Suhu cenderung meningkat pada siang hari, tetapi masih dalam rentang batas aman.',
                isNormal: true
            },
            '2A': {
                avg: '28,1°C', max: '31,2°C', min: '25,0°C',
                chartData: [25.0, 27.2, 29.1, 31.2, 30.8, 29.5, 28.0],
                aiText: 'Peringatan: Suhu kelas melebihi batas ideal (28°C) pada pukul 12:00 - 14:00.',
                isNormal: false
            },
            'Lab': {
                avg: '27,8°C', max: '30,5°C', min: '24,2°C',
                chartData: [24.2, 26.0, 28.5, 30.5, 29.8, 28.9, 27.2],
                aiText: 'Kelembapan tinggi terdeteksi bersamaan dengan peningkatan suhu alat lab.',
                isNormal: false
            }
        };

        function updateDashboardData() {
            const selectedRoom = document.getElementById('roomSelect').value;
            const data = roomDatasets[selectedRoom] || roomDatasets['1A'];

            // Update stats
            document.getElementById('statAvg').innerText = data.avg;
            document.getElementById('statMax').innerText = data.max;
            document.getElementById('statMin').innerText = data.min;

            // Update AI analysis
            document.getElementById('aiSummary').innerText = data.aiText;

            const badge = document.getElementById('aiBadge');
            if (data.isNormal) {
                badge.className = "inline-flex items-center gap-1.5 bg-sage-600 text-white font-semibold text-xs px-4 py-2 rounded-full shrink-0 shadow-sm";
                badge.innerHTML = `<i data-lucide="check-circle-2" class="w-4 h-4"></i> Status: Normal`;
            } else {
                badge.className = "inline-flex items-center gap-1.5 bg-amber-500 text-white font-semibold text-xs px-4 py-2 rounded-full shrink-0 shadow-sm";
                badge.innerHTML = `<i data-lucide="alert-triangle" class="w-4 h-4"></i> Status: Peringatan`;
            }

            // Update Chart
            tempChart.data.datasets[0].data = data.chartData;
            tempChart.update();

            // Refresh lucide icons
            lucide.createIcons();
        }
    </script>
</body>
</html>