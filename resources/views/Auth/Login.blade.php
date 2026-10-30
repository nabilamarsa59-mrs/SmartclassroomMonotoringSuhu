<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartClassroom - Monitoring Suhu Ruangan</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        sage: {
                            50: '#f4f7f4',
                            100: '#e3ebe3',
                            200: '#c7d7c7',
                            300: '#a3be9e',
                            400: '#7ca07d',
                            500: '#5c835d',
                            600: '#476948',
                            700: '#3a543b',
                            800: '#314432',
                            900: '#2a3a2b',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .wave-bg {
            background-color: #f6f8f6;
            background-image: radial-gradient(#476948 0.5px, transparent 0.5px), radial-gradient(#476948 0.5px, #f6f8f6 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.15;
        }
        .dark .wave-bg {
            background-color: #1a231b;
            background-image: radial-gradient(#7ca07d 0.5px, transparent 0.5px), radial-gradient(#7ca07d 0.5px, #1a231b 0.5px);
            opacity: 0.1;
        }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-zinc-900 text-slate-800 dark:text-zinc-100 min-h-screen transition-colors duration-300">

    <!-- Top Controls (Dark Mode Toggle) -->
    <div class="fixed top-4 right-4 z-50 flex items-center gap-2">
        <button id="themeToggle" class="p-2.5 rounded-full bg-white/80 dark:bg-zinc-800/80 shadow-md backdrop-blur border border-slate-200 dark:border-zinc-700 text-slate-600 dark:text-zinc-300 hover:text-sage-700 dark:hover:text-sage-400 transition-all cursor-pointer">
            <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
            <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
        </button>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12 overflow-hidden">
        
        <!-- Left Section: Branding & Graphics -->
        <div class="lg:col-span-7 relative bg-gradient-to-br from-sage-50 via-emerald-50/40 to-sage-100 dark:from-zinc-900 dark:via-zinc-800 dark:to-sage-950 flex flex-col justify-between p-8 lg:p-16 border-b lg:border-b-0 lg:border-r border-slate-200/60 dark:border-zinc-800">
            <div class="absolute inset-0 wave-bg pointer-events-none"></div>

            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-sage-600 dark:bg-sage-700 flex items-center justify-center text-white shadow-md shadow-sage-600/20">
                    <i data-lucide="thermometer-snowflake" class="w-6 h-6"></i>
                </div>
                <span class="font-semibold text-lg text-slate-800 dark:text-zinc-100 tracking-tight">SmartClassroom</span>
            </div>

            <div class="relative z-10 my-auto py-12 lg:py-0 max-w-lg">
                <div class="w-24 h-24 mb-8 rounded-3xl bg-white dark:bg-zinc-800/80 shadow-xl shadow-sage-900/5 p-4 flex items-center justify-center border border-slate-100 dark:border-zinc-700/50">
                    <div class="relative w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-sage-700 dark:text-sage-400" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 28L32 12L52 28V50C52 52.2 50.2 54 48 54H16C13.8 54 12 52.2 12 50V28Z" />
                            <path d="M30 32V42M30 42A3 3 0 1 0 34 42A3 3 0 0 0 30 42Z" stroke-width="3" />
                            <path d="M44 18C44 18 52 18 52 26C52 34 44 34 44 34C44 34 44 26 44 18Z" fill="currentColor" fill-opacity="0.2" class="text-sage-600" />
                        </svg>
                    </div>
                </div>

                <h1 class="text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white tracking-tight mb-3">
                    SmartClassroom
                </h1>
                <p class="text-lg lg:text-xl font-medium text-sage-700 dark:text-sage-300 mb-4">
                    Monitoring Suhu Ruangan
                </p>
                <p class="text-slate-600 dark:text-zinc-400 leading-relaxed text-sm lg:text-base">
                    Sistem pemantauan dan kontrol suhu ruangan kelas cerdas berbasis IoT. Wujudkan lingkungan belajar yang nyaman dan kondusif secara akurat dan efisien.
                </p>

                <div class="mt-8 grid grid-cols-2 gap-4 max-w-sm">
                    <div class="bg-white/70 dark:bg-zinc-800/50 backdrop-blur p-3.5 rounded-2xl border border-slate-200/80 dark:border-zinc-700/60 flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400">
                            <i data-lucide="thermometer" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 dark:text-zinc-400">Suhu Rata-rata</div>
                            <div class="text-sm font-semibold text-slate-800 dark:text-zinc-200">24.5 °C</div>
                        </div>
                    </div>
                    <div class="bg-white/70 dark:bg-zinc-800/50 backdrop-blur p-3.5 rounded-2xl border border-slate-200/80 dark:border-zinc-700/60 flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            <i data-lucide="droplets" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 dark:text-zinc-400">Kelembapan</div>
                            <div class="text-sm font-semibold text-slate-800 dark:text-zinc-200">58 %</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative z-10 text-xs text-slate-500 dark:text-zinc-500 hidden lg:block">
                &copy; 2026 SmartClassroom IoT System. All rights reserved.
            </div>
        </div>

        <!-- Right Section: Login Form -->
        <div class="lg:col-span-5 flex items-center justify-center p-6 lg:p-12 bg-white dark:bg-zinc-900">
            <div class="w-full max-w-md space-y-8">
                
                <div>
                    <h2 class="text-2xl lg:text-3xl font-bold text-slate-900 dark:text-white tracking-tight">
                        Masuk
                    </h2>
                    <p class="mt-2 text-sm text-slate-500 dark:text-zinc-400">
                        Masukkan NIP untuk mengakses akun Anda
                    </p>
                </div>

                <div id="alertBox" class="hidden p-4 rounded-xl text-sm border transition-all duration-200"></div>

                <!-- Form -->
                <form id="loginForm" onsubmit="handleLogin(event)" class="space-y-5">
                    
                    <div class="space-y-1.5">
                        <label for="nip" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                            NIP
                        </label>
                        <div class="relative rounded-2xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-zinc-500">
                                <i data-lucide="user" class="w-5 h-5"></i>
                            </div>
                            <input 
                                type="text" 
                                id="nip" 
                                required
                                placeholder="Masukkan NIP" 
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-zinc-800/80 border border-slate-200 dark:border-zinc-700 rounded-xl text-sm text-slate-900 dark:text-zinc-100 placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-sage-600 focus:border-transparent transition-all"
                            >
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                            Kata Sandi
                        </label>
                        <div class="relative rounded-2xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-zinc-500">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                required
                                placeholder="Masukkan kata sandi" 
                                class="w-full pl-11 pr-11 py-3 bg-slate-50 dark:bg-zinc-800/80 border border-slate-200 dark:border-zinc-700 rounded-xl text-sm text-slate-900 dark:text-zinc-100 placeholder-slate-400 dark:placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-sage-600 focus:border-transparent transition-all"
                            >
                            <button 
                                type="button" 
                                onclick="togglePasswordVisibility()" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:text-zinc-500 dark:hover:text-zinc-300 focus:outline-none transition-colors cursor-pointer"
                            >
                                <i data-lucide="eye" id="eyeIcon" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm pt-1">
                        <label class="flex items-center gap-2.5 cursor-pointer group">
                            <input 
                                type="checkbox" 
                                class="w-4 h-4 rounded border-slate-300 dark:border-zinc-700 text-sage-600 focus:ring-sage-500 dark:bg-zinc-800 accent-sage-600 cursor-pointer"
                            >
                            <span class="text-slate-600 dark:text-zinc-400 group-hover:text-slate-800 dark:group-hover:text-zinc-200 transition-colors">
                                Ingat saya
                            </span>
                        </label>
                        <a href="javascript:void(0)" onclick="showAlert('Sila hubungi Administrator sekolah/kampus untuk reset kata sandi NIP Anda.', 'info')" class="font-medium text-sage-700 hover:text-sage-800 dark:text-sage-400 dark:hover:text-sage-300 hover:underline">
                            Lupa kata sandi?
                        </a>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-3.5 px-6 mt-2 bg-sage-700 hover:bg-sage-800 text-white font-medium rounded-xl shadow-lg shadow-sage-700/25 focus:outline-none focus:ring-2 focus:ring-sage-600 focus:ring-offset-2 dark:focus:ring-offset-zinc-900 transition-all flex items-center justify-center gap-2 group cursor-pointer"
                    >
                        <span>Masuk</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>

                <div class="pt-6 border-t border-slate-100 dark:border-zinc-800 text-center">
                    <p class="text-xs text-slate-400 dark:text-zinc-500">
                        Akses diberikan sesuai hak akses akun
                    </p>
                </div>

            </div>
        </div>

    </div>

    <!-- JavaScript Logic -->
    <script>
        lucide.createIcons();

        const themeToggleBtn = document.getElementById('themeToggle');
        
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }

        function showAlert(message, type = 'error') {
            const alertBox = document.getElementById('alertBox');
            alertBox.classList.remove('hidden', 'bg-red-50', 'text-red-700', 'border-red-200', 'bg-blue-50', 'text-blue-700', 'border-blue-200', 'bg-emerald-50', 'text-emerald-700', 'border-emerald-200', 'dark:bg-red-950/30', 'dark:text-red-300', 'dark:border-red-800/50', 'dark:bg-blue-950/30', 'dark:text-blue-300', 'dark:border-blue-800/50', 'dark:bg-emerald-950/30', 'dark:text-emerald-300', 'dark:border-emerald-800/50');

            if (type === 'error') {
                alertBox.classList.add('bg-red-50', 'text-red-700', 'border-red-200', 'dark:bg-red-950/30', 'dark:text-red-300', 'dark:border-red-800/50');
            } else if (type === 'info') {
                alertBox.classList.add('bg-blue-50', 'text-blue-700', 'border-blue-200', 'dark:bg-blue-950/30', 'dark:text-blue-300', 'dark:border-blue-800/50');
            } else if (type === 'success') {
                alertBox.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200', 'dark:bg-emerald-950/30', 'dark:text-emerald-300', 'dark:border-emerald-800/50');
            }

            alertBox.innerText = message;
        }

        function handleLogin(event) {
            event.preventDefault();
            const nip = document.getElementById('nip').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!nip || !password) {
                showAlert('Harap isi NIP dan kata sandi Anda.', 'error');
                return;
            }

            showAlert('Login berhasil! Mengalihkan ke dashboard monitoring...', 'success');
            
            setTimeout(() => {
                // Arahkan ke dashboard jika sudah siap
            }, 1500);
        }
    </script>
</body>
</html>