<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartClassroom - Pengaturan Pengguna</title>
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
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Font: Inter -->
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

            <!-- User Info Badge in Sidebar -->
            <div class="p-4 mx-4 my-4 bg-sage-50 rounded-xl border border-sage-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-sage-200 flex items-center justify-center text-sage-700 font-semibold text-sm">
                    NB
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800" id="sidebarUserName">Bu Nabila</p>
                    <p class="text-xs text-slate-500">Guru</p>
                </div>
            </div>

            <!-- Navigation Links -->
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
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>

        <!-- Logout Button in Sidebar -->
        <div class="p-4 border-t border-sage-100">
            <button onclick="confirmLogout()" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl transition text-left">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span>Keluar</span>
            </button>
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
                    <h2 class="text-xl font-bold text-slate-800">Pengaturan Pengguna</h2>
                    <p class="text-xs text-slate-500">Kelola informasi data diri dan akun Anda</p>
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
        <main class="p-6 md:p-8 flex-1 overflow-y-auto max-w-4xl space-y-6">
            
            <!-- Pengaturan HEADER CARD -->
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm flex flex-col sm:flex-row items-center gap-6">
                <!-- Avatar Circle -->
                <div class="relative group">
                    <div class="w-24 h-24 rounded-full bg-sage-100 border-2 border-sage-200 flex items-center justify-center text-sage-600 shadow-inner overflow-hidden">
                        <i data-lucide="user" class="w-12 h-12 stroke-[1.5]"></i>
                    </div>
                    <button onclick="openModal('editModal')" class="absolute bottom-0 right-0 p-2 bg-sage-600 text-white rounded-full hover:bg-sage-700 transition shadow-md" title="Ubah Foto">
                        <i data-lucide="camera" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Name & Role -->
                <div class="text-center sm:text-left flex-1">
                    <h3 id="displayHeaderName" class="text-2xl font-bold text-slate-800">Bu Nabila</h3>
                    <p class="text-sm font-semibold text-sage-600 mt-1">Guru / Pengajar</p>
                    <p class="text-xs text-slate-400 mt-1">Status Akun: Aktif • Terakhir login hari ini</p>
                </div>

                <!-- Quick Action Edit -->
                <button onclick="openModal('editModal')" class="px-4 py-2.5 bg-sage-50 border border-sage-200 hover:bg-sage-100 text-sage-700 rounded-xl font-semibold text-sm transition flex items-center gap-2">
                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                    <span>Edit Pengaturan</span>
                </button>
            </div>

            <!-- Pengaturan DETAILS FIELD LIST (Matching Wireframe) -->
            <div class="space-y-3">
                <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider px-1">Informasi Diri</h4>

                <!-- NIP Field Card -->
                <div class="bg-white border border-slate-100 p-4 rounded-2xl shadow-sm flex items-center justify-between hover:border-sage-200 transition group cursor-pointer" onclick="openModal('editModal')">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-xl bg-sage-50 text-sage-700 flex items-center justify-center">
                            <i data-lucide="user-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">NIP</p>
                            <p id="displayNip" class="text-base font-bold text-slate-800 mt-0.5">33451</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                </div>

                <!-- Nama Field Card -->
                <div class="bg-white border border-slate-100 p-4 rounded-2xl shadow-sm flex items-center justify-between hover:border-sage-200 transition group cursor-pointer" onclick="openModal('editModal')">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-xl bg-sage-50 text-sage-700 flex items-center justify-center">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">Nama Lengkap</p>
                            <p id="displayName" class="text-base font-bold text-slate-800 mt-0.5">Nabila</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                </div>

                <!-- Email Field Card -->
                <div class="bg-white border border-slate-100 p-4 rounded-2xl shadow-sm flex items-center justify-between hover:border-sage-200 transition group cursor-pointer" onclick="openModal('editModal')">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-xl bg-sage-50 text-sage-700 flex items-center justify-center">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">Email</p>
                            <p id="displayEmail" class="text-base font-bold text-slate-800 mt-0.5">nabila@gmail.com</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                </div>

                <!-- No. Tlp Field Card -->
                <div class="bg-white border border-slate-100 p-4 rounded-2xl shadow-sm flex items-center justify-between hover:border-sage-200 transition group cursor-pointer" onclick="openModal('editModal')">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-xl bg-sage-50 text-sage-700 flex items-center justify-center">
                            <i data-lucide="phone" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">No. Telepon</p>
                            <p id="displayPhone" class="text-base font-bold text-slate-800 mt-0.5">+62 851 2244 7789</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"></i>
                </div>
            </div>

            <!-- PROMINENT LOGOUT BUTTON (Matching Wireframe Solid Green Button) -->
            <div class="pt-4">
                <button onclick="confirmLogout()" class="w-full bg-sage-600 hover:bg-sage-700 active:bg-sage-800 text-white font-semibold py-4 px-6 rounded-2xl shadow-md transition flex items-center justify-center gap-3">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span>Keluar</span>
                </button>
            </div>

        </main>
    </div>

    <!-- MODAL EDIT Pengaturan -->
    <div id="editModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-sage-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-sage-100">
                <h3 class="text-lg font-bold text-slate-800">Edit Pengaturan</h3>
                <button onclick="closeModal('editModal')" class="text-slate-400 hover:text-slate-600 p-1">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="PengaturanForm" onsubmit="savePengaturan(event)" class="mt-4 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">NIP</label>
                    <input type="text" id="inputNip" value="33451" class="w-full bg-sage-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-sage-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                    <input type="text" id="inputName" value="Nabila" class="w-full bg-sage-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-sage-600 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Email</label>
                    <input type="email" id="inputEmail" value="nabila@gmail.com" class="w-full bg-sage-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-sage-600 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">No. Telepon</label>
                    <input type="text" id="inputPhone" value="+62 851 2244 7789" class="w-full bg-sage-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-sage-600 focus:outline-none" required>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="closeModal('editModal')" class="flex-1 px-4 py-3 border border-slate-200 text-slate-600 rounded-xl font-semibold text-sm hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-sage-600 hover:bg-sage-700 text-white rounded-xl font-semibold text-sm shadow transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- NOTIFICATION TOAST -->
    <div id="toast" class="fixed bottom-6 right-6 bg-slate-900 text-white px-5 py-3 rounded-2xl shadow-xl flex items-center gap-3 translate-y-20 opacity-0 transition-all duration-300 z-50">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400"></i>
        <span id="toastMessage" class="text-sm font-medium">Pengaturan berhasil diperbarui</span>
    </div>

    <script>
        lucide.createIcons();

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function savePengaturan(event) {
            event.preventDefault();
            
            const nip = document.getElementById('inputNip').value;
            const name = document.getElementById('inputName').value;
            const email = document.getElementById('inputEmail').value;
            const phone = document.getElementById('inputPhone').value;

            document.getElementById('displayNip').innerText = nip;
            document.getElementById('displayName').innerText = name;
            document.getElementById('displayEmail').innerText = email;
            document.getElementById('displayPhone').innerText = phone;
            document.getElementById('displayHeaderName').innerText = 'Bu ' + name;
            document.getElementById('sidebarUserName').innerText = 'Bu ' + name;

            closeModal('editModal');
            showToast('Pengaturan berhasil diperbarui!');
        }

        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').innerText = msg;
            toast.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);
        }

        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin keluar dari akun SmartClassroom?')) {
                showToast('Logout berhasil...');
            }
        }
    </script>
</body>
</html>