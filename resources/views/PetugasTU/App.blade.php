<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') · SmartClassroom</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">

    <style>

:root {
    --paper:   #F3F5EE;
    --card:    #FBFCF8;
    --sage:    #E3EADD;
    --line:    #D3DCCB;
    --forest:  #2A4838;
    --forest-2:#3C6150;
    --moss:    #7D9B85;
    --ink:     #1C2921;
    --mute:    #627166;
    --amber:   #8F5A14;
    --amber-bg:#F3E6CC;
    --brick:   #9B3F2E;
    --brick-bg:#F4DDD6;

    --radius: 14px;
    --font-head: "Bricolage Grotesque", "Segoe UI", sans-serif;
    --font-body: "Figtree", "Segoe UI", system-ui, sans-serif;
}

*, *::before, *::after { box-sizing: border-box; }
html { -webkit-text-size-adjust: 100%; }
body {
    margin: 0;
    background: var(--paper);
    color: var(--ink);
    font: 400 16px/1.55 var(--font-body);
}
h1, h2, h3, p, dl, dd, ul, ol { margin: 0; padding: 0; }
ul, ol { list-style: none; }
a { color: inherit; text-decoration: none; }
small { display: block; font-size: .8125rem; color: var(--mute); }
button, input, select { font: inherit; color: inherit; }

:focus-visible { outline: 3px solid var(--moss); outline-offset: 2px; border-radius: 6px; }

.skip { position: absolute; left: -999px; top: 8px; background: var(--forest); color: #fff; padding: 8px 14px; border-radius: 8px; z-index: 100; }
.skip:focus { left: 8px; }
.muted { color: var(--mute); }

/* ---------- Kerangka ---------- */
.shell { display: grid; grid-template-columns: 260px 1fr; min-height: 100vh; }
.main  { padding: 40px clamp(20px, 4vw, 56px) 64px; max-width: 1120px; width: 100%; }

/* ---------- Sidebar ---------- */
.sidebar {
    position: sticky; top: 0; height: 100vh;
    display: flex; flex-direction: column; gap: 32px;
    padding: 28px 18px;
    background: var(--sage);
    border-right: 1px solid var(--line);
}
.brand { display: flex; align-items: center; gap: 12px; padding: 0 8px; }
.brand-mark {
    display: grid; place-items: center; width: 40px; height: 40px;
    background: var(--forest); color: #fff; border-radius: 12px;
}
.brand strong { font: 700 1.0625rem/1.2 var(--font-head); display: block; }

.nav { display: flex; flex-direction: column; gap: 4px; }
.nav-link {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 14px; border-radius: 10px;
    color: var(--mute); font-weight: 500;
    transition: background .15s, color .15s;
}
.nav-link:hover { background: rgba(255,255,255,.55); color: var(--ink); }
.nav-link.is-active { background: var(--forest); color: #fff; }

.sidebar-foot {
    margin-top: auto; display: flex; align-items: center; gap: 12px;
    padding: 14px 8px 0; border-top: 1px solid var(--line);
}
.sidebar-foot strong { display: block; line-height: 1.2; }

.avatar {
    display: grid; place-items: center; flex: none;
    width: 40px; height: 40px; border-radius: 50%;
    background: var(--forest-2); color: #fff; font: 700 1rem var(--font-head);
}
.avatar-sm { width: 34px; height: 34px; font-size: .875rem; background: var(--moss); }
.avatar-lg { width: 84px; height: 84px; font-size: 2rem; margin-bottom: 8px; }

/* ---------- Judul halaman ---------- */
.page-head {
    display: flex; align-items: flex-end; justify-content: space-between;
    gap: 16px; flex-wrap: wrap; margin-bottom: 28px;
}
.page-head h1 { font: 700 clamp(1.75rem, 3vw, 2.25rem)/1.15 var(--font-head); letter-spacing: -.01em; }
.page-head p  { color: var(--mute); margin-top: 4px; }

.section-title { font: 700 1.125rem/1.3 var(--font-head); }

/* ---------- Hero (gelombang dari mockup) ---------- */
.hero {
    position: relative; overflow: hidden;
    background: var(--forest); color: #fff;
    border-radius: 20px;
    padding: 40px clamp(24px, 4vw, 48px) 120px;
    margin-bottom: 20px;
}
.hero-body { position: relative; z-index: 1; max-width: 520px; }
.hero h2 { font: 700 clamp(1.75rem, 3.4vw, 2.5rem)/1.1 var(--font-head); letter-spacing: -.015em; }
.hero p  { margin-top: 10px; color: #D6E4D9; }
.hero .hero-live {
    display: inline-flex; align-items: center; gap: 10px;
    margin-top: 22px; padding: 7px 14px;
    background: rgba(255,255,255,.12); border-radius: 999px;
    color: #fff; font-weight: 500; font-size: .9375rem;
}
.dot { width: 9px; height: 9px; border-radius: 50%; background: #A9D8B5; box-shadow: 0 0 0 4px rgba(169,216,181,.25); }
.wave { position: absolute; left: 0; bottom: -1px; width: 100%; height: 100px; display: block; }
.wave-1 { fill: #36594A; }
.wave-2 { fill: #476E5B; }
.wave-3 { fill: #5E8570; }

/* ---------- Aksi cepat ---------- */
.actions { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 20px; }
.action {
    display: flex; align-items: center; gap: 16px;
    padding: 20px 22px; background: var(--card);
    border: 1px solid var(--line); border-radius: var(--radius);
    transition: border-color .15s, background .15s;
}
.action:hover { border-color: var(--moss); background: #fff; }
.action strong { display: block; font: 700 1.0625rem/1.3 var(--font-head); }
.action-icon {
    display: grid; place-items: center; flex: none;
    width: 52px; height: 52px; border-radius: 14px;
    background: var(--sage); color: var(--forest);
}
.action-arrow { margin-left: auto; color: var(--moss); flex: none; }

/* ---------- Panel & statistik ---------- */
.panel { background: var(--card); border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; margin-bottom: 20px; }
.panel-head { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px; }
.link { color: var(--forest-2); font-weight: 600; font-size: .9375rem; }
.link:hover { text-decoration: underline; }

.stats { display: grid; grid-template-columns: repeat(3, 1fr); margin-top: 16px; }
.stat { padding: 4px 24px; border-left: 1px solid var(--line); }
.stat:first-child { padding-left: 0; border-left: 0; }
.stat dt { color: var(--mute); font-size: .9375rem; }
.stat dd { font: 700 3rem/1.1 var(--font-head); color: var(--forest); margin-top: 4px; }

.two-col { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
.two-col .panel { margin-bottom: 0; }
.two-col-profile { grid-template-columns: 320px 1fr; align-items: start; }

.rows .row {
    display: flex; justify-content: space-between; align-items: center; gap: 16px;
    padding: 13px 0; border-bottom: 1px solid var(--line);
}
.rows .row:last-child { border-bottom: 0; padding-bottom: 0; }
.rows strong { font-weight: 600; }

/* ---------- Badge & tag ---------- */
.badge {
    display: inline-block; padding: 3px 12px; border-radius: 999px;
    font-size: .8125rem; font-weight: 600; white-space: nowrap;
    background: var(--sage); color: var(--mute);
}
.badge-terpakai, .badge-mengajar { background: #D4E6D8; color: var(--forest); }
.badge-kosong, .badge-istirahat  { background: #E8ECE4; color: var(--mute); }
.badge-perawatan, .badge-cuti    { background: var(--amber-bg); color: var(--amber); }

.tag { display: inline-block; padding: 2px 10px; border: 1px solid var(--line); border-radius: 8px; font-size: .8125rem; color: var(--mute); }

/* ---------- Toolbar, pencarian, filter ---------- */
.toolbar { display: flex; flex-wrap: wrap; gap: 12px 16px; align-items: center; margin-bottom: 20px; }
.search {
    display: flex; align-items: center; gap: 10px;
    flex: 1 1 260px; max-width: 380px;
    padding: 0 14px; height: 44px;
    background: var(--card); border: 1px solid var(--line); border-radius: 12px;
    color: var(--mute);
}
.search:focus-within { border-color: var(--forest-2); }
.search input { flex: 1; border: 0; background: transparent; outline: 0; height: 100%; color: var(--ink); min-width: 0; }

.chips { display: flex; gap: 8px; flex-wrap: wrap; }
.chip {
    height: 40px; padding: 0 16px; border-radius: 999px; cursor: pointer;
    background: transparent; border: 1px solid var(--line); color: var(--mute); font-weight: 500;
}
.chip:hover { border-color: var(--moss); color: var(--ink); }
.chip.is-on { background: var(--forest); border-color: var(--forest); color: #fff; }

/* ---------- Tombol ---------- */
.btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    height: 44px; padding: 0 20px; border-radius: 12px; cursor: pointer;
    background: var(--card); border: 1px solid var(--line); font-weight: 600;
    transition: background .15s, border-color .15s;
}
.btn:hover { border-color: var(--moss); }
.btn-primary { background: var(--forest); border-color: var(--forest); color: #fff; }
.btn-primary:hover { background: var(--forest-2); border-color: var(--forest-2); }
.btn-danger { color: var(--brick); border-color: #E3C3BA; margin-top: 20px; }
.btn-danger:hover { background: var(--brick-bg); border-color: var(--brick); }
.icon-btn { display: grid; place-items: center; width: 40px; height: 40px; border: 0; background: transparent; border-radius: 10px; cursor: pointer; color: var(--mute); }
.icon-btn:hover { background: var(--sage); }

/* ---------- Kartu ruangan ---------- */
.grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 16px; }
.room {
    display: flex; flex-direction: column; gap: 14px;
    background: var(--card); border: 1px solid var(--line); border-radius: var(--radius); padding: 20px;
}
.room header { display: flex; justify-content: space-between; align-items: center; gap: 12px; }
.room h2 { font: 700 1.375rem/1.2 var(--font-head); }
.room-who { font-weight: 600; min-height: 2.9em; }
.room-who .muted { font-weight: 400; }
.room-meta { display: grid; grid-template-columns: repeat(3, auto); justify-content: space-between; gap: 8px; padding: 12px 0; border-block: 1px solid var(--line); }
.room-meta dt { font-size: .8125rem; color: var(--mute); }
.room-meta dd { font-weight: 600; }
.room footer { display: flex; gap: 6px; flex-wrap: wrap; }

/* ---------- Tabel guru ---------- */
.table-wrap { overflow-x: auto; background: var(--card); border: 1px solid var(--line); border-radius: var(--radius); }
.table { width: 100%; border-collapse: collapse; min-width: 640px; }
.table th { text-align: left; padding: 14px 20px; font-size: .875rem; font-weight: 600; color: var(--mute); background: var(--sage); }
.table td { padding: 14px 20px; border-top: 1px solid var(--line); vertical-align: middle; }
.table tbody tr:hover { background: #F6F8F1; }
.person { display: flex; align-items: center; gap: 12px; }
.person strong { display: block; line-height: 1.25; }

/* ---------- Profil ---------- */
.profile-card { display: flex; flex-direction: column; align-items: flex-start; }
.profile-card h2 { font: 700 1.5rem/1.2 var(--font-head); }

/* ---------- Form & dialog ---------- */
.fields { display: grid; gap: 16px; margin-top: 16px; }
.fields-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
label { display: grid; gap: 6px; font-weight: 600; font-size: .9375rem; }
input[type=text], input[type=email], input[type=tel], input[type=number], select {
    height: 46px; padding: 0 14px; border: 1px solid var(--line); border-radius: 10px;
    background: #fff; font-weight: 400; width: 100%;
}
input:focus, select:focus { outline: 3px solid rgba(125,155,133,.45); border-color: var(--forest-2); }
.form-actions { margin-top: 24px; }

.dialog { border: 0; padding: 0; border-radius: 18px; width: min(480px, calc(100vw - 32px)); background: var(--card); color: var(--ink); box-shadow: 0 24px 60px rgba(28,41,33,.28); }
.dialog::backdrop { background: rgba(28,41,33,.45); }
.dialog form { padding: 24px; }
.dialog header { display: flex; justify-content: space-between; align-items: center; }
.dialog header h2 { font: 700 1.375rem var(--font-head); }
.dialog footer { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; }

.empty { padding: 40px 16px; text-align: center; color: var(--mute); border: 1px dashed var(--line); border-radius: var(--radius); }
[hidden] { display: none !important; }

/* ---------- Toast ---------- */
.toast {
    position: fixed; left: 50%; bottom: 28px; z-index: 60;
    transform: translate(-50%, 24px); opacity: 0; pointer-events: none;
    background: var(--forest); color: #fff; padding: 12px 20px; border-radius: 12px; font-weight: 500;
    transition: opacity .2s, transform .2s;
}
.toast.is-show { opacity: 1; transform: translate(-50%, 0); }

/* ---------- Responsif: sidebar jadi navigasi bawah (seperti mockup) ---------- */
@media (max-width: 900px) {
    .shell { grid-template-columns: 1fr; }
    .main { padding: 24px 18px 110px; }

    .sidebar {
        position: fixed; inset: auto 0 0 0; z-index: 40; height: auto;
        flex-direction: row; padding: 6px 8px calc(6px + env(safe-area-inset-bottom));
        border-right: 0; border-top: 1px solid var(--line); background: var(--card);
    }
    .brand, .sidebar-foot { display: none; }
    .nav { flex-direction: row; width: 100%; justify-content: space-around; }
    .nav-link { flex-direction: column; gap: 2px; padding: 8px 10px; font-size: .75rem; background: none !important; color: var(--mute); }
    .nav-link.is-active { color: var(--forest); font-weight: 600; }
    .nav-link.is-active svg { stroke-width: 2.2; }

    .actions, .two-col, .two-col-profile { grid-template-columns: 1fr; }
    .stat { padding: 4px 14px; }
    .stat dd { font-size: 2.25rem; }
    .hero { padding-bottom: 100px; }
    .toast { bottom: 96px; }
}

@media (max-width: 520px) {
    .fields-2 { grid-template-columns: 1fr; }
    .timeline li { grid-template-columns: 1fr auto; }
    .timeline time { grid-column: 1 / -1; }
    .page-head .btn { width: 100%; }
}

@media (prefers-reduced-motion: reduce) {
    * { transition: none !important; }
}

/* ---------- Ikon (sprite) ---------- */
.ic { width: 22px; height: 22px; flex: none; fill: none; stroke: currentColor; stroke-width: 1.7; stroke-linecap: round; stroke-linejoin: round; }
.ic-18 { width: 18px; height: 18px; }
.ic-20 { width: 20px; height: 20px; }
.ic-26 { width: 26px; height: 26px; }

    </style>
</head>
<body>
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <symbol id="i-home" viewBox="0 0 24 24"><path d="M3 11l9-7 9 7v9a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></symbol>
        <symbol id="i-building" viewBox="0 0 24 24"><rect x="5" y="3" width="14" height="18" rx="1"/><path d="M9 7h2M13 7h2M9 11h2M13 11h2M10 21v-4h4v4"/></symbol>
        <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
        <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></symbol>
        <symbol id="i-users" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c0-3.5 3-5.5 6.5-5.5s6.5 2 6.5 5.5"/><path d="M16 4.6a3.5 3.5 0 0 1 0 6.8M18.5 14.8c1.8.7 3 2.2 3 5.2"/></symbol>
        <symbol id="i-board" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="12" rx="1.5"/><path d="M8 20h8M12 16v4"/></symbol>
        <symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></symbol>
        <symbol id="i-plus" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></symbol>
        <symbol id="i-logout" viewBox="0 0 24 24"><path d="M9 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h4M16 8l4 4-4 4M20 12H9"/></symbol>
        <symbol id="i-chevron" viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></symbol>
        <symbol id="i-close" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></symbol>
    </svg>

    <a class="skip" href="#konten">Lewati ke konten</a>

    @php
        $menu = [
            ['route' => 'tu.beranda', 'label' => 'Beranda', 'icon' => 'home'],
            ['route' => 'tu.ruangan', 'label' => 'kelola Ruangan', 'icon' => 'building'],
            ['route' => 'tu.guru',    'label' => 'Kelola Guru',    'icon' => 'users'],
            ['route' => 'tu.profil',  'label' => 'Profil',  'icon' => 'user'],
        ];
    @endphp

    <div class="shell">
        <aside class="sidebar">
            <a href="{{ route('tu.beranda') }}" class="brand">
                <span class="brand-mark"><svg class="ic ic-20"><use href="#i-building"/></svg></span>
                <span>
                    <strong>SmartClassroom</strong>
                    <small>Panel Tata Usaha</small>
                </span>
            </a>

            <nav class="nav" aria-label="Menu utama">
                @foreach ($menu as $item)
                    <a href="{{ route($item['route']) }}"
                       class="nav-link {{ request()->routeIs($item['route']) ? 'is-active' : '' }}"
                       @if (request()->routeIs($item['route'])) aria-current="page" @endif>
                        <svg class="ic"><use href="#i-{{ $item['icon'] }}"/></svg>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="sidebar-foot">
                <span class="avatar">S</span>
                <span>
                    <strong>Sarah</strong>
                    <small>TU / Administrator</small>
                </span>
            </div>
        </aside>

        <main class="main" id="konten">
            @yield('content')
        </main>
    </div>

    <div class="toast" id="toast" role="status" aria-live="polite"></div>

    <script>
(function () {
    'use strict';

    /* ---------- Toast ---------- */
    var toastEl = document.getElementById('toast');
    var toastTimer;
    function toast(msg) {
        if (!toastEl) return;
        toastEl.textContent = msg;
        toastEl.classList.add('is-show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { toastEl.classList.remove('is-show'); }, 2600);
    }

    /* ---------- Dialog ---------- */
    document.querySelectorAll('[data-open]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var dlg = document.getElementById(btn.dataset.open);
            if (dlg && dlg.showModal) dlg.showModal();
        });
    });
    document.querySelectorAll('[data-close]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var dlg = btn.closest('dialog');
            if (dlg) dlg.close();
        });
    });
    document.querySelectorAll('dialog').forEach(function (dlg) {
        dlg.addEventListener('click', function (e) {
            if (e.target === dlg) dlg.close();   // klik area gelap = tutup
        });
    });

    /* ---------- Form contoh (belum terhubung ke backend) ---------- */
    document.querySelectorAll('[data-demo-form]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var dlg = form.closest('dialog');
            if (dlg) dlg.close();
            toast(form.dataset.toast || 'Tersimpan');
        });
    });

    /* Tombol biasa yang hanya menampilkan toast */
    document.querySelectorAll('button[data-toast]').forEach(function (btn) {
        btn.addEventListener('click', function () { toast(btn.dataset.toast); });
    });

    /* ---------- Cari + filter status ---------- */
    var list = document.querySelector('[data-list]');
    if (!list) return;

    var items  = Array.prototype.slice.call(list.querySelectorAll('[data-item]'));
    var groups = Array.prototype.slice.call(list.querySelectorAll('[data-group]'));
    var chips  = document.querySelectorAll('[data-chip]');
    var search = document.querySelector('[data-search]');
    var empty  = document.querySelector('[data-empty]');
    var status = 'Semua';

    function apply() {
        var q = search ? search.value.trim().toLowerCase() : '';
        var shown = 0;

        items.forEach(function (el) {
            var okStatus = status === 'Semua' || el.dataset.status === status;
            var okText   = !q || (el.dataset.text || '').indexOf(q) !== -1;
            var visible  = okStatus && okText;
            el.hidden = !visible;
            if (visible) shown++;
        });

        groups.forEach(function (g) {
            g.hidden = !g.querySelector('[data-item]:not([hidden])');
        });

        if (empty) empty.hidden = shown !== 0;
    }

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            status = chip.dataset.chip;
            chips.forEach(function (c) { c.classList.toggle('is-on', c === chip); });
            apply();
        });
    });
    if (search) search.addEventListener('input', apply);
})();

    </script>
</body>
</html>