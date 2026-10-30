<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - SmartClassroom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f4f8f5; --panel: #ffffff; --ink: #0f172a; --muted: #64748b;
            --brand: #3b5a3d; --brand-dark: #2f4a31; --field: #f7f9fa; --line: #e5e7eb;
            --card: #ffffffcc; --error: #b42318;
        }
        :root[data-theme="dark"] {
            --bg: #101a14; --panel: #0b120e; --ink: #f1f5f2; --muted: #9bb0a2;
            --brand: #5f8a62; --brand-dark: #4f7752; --field: #1a2820; --line: #223227;
            --card: #16221b; --error: #ff8a7a;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Inter', system-ui, sans-serif; color: var(--ink); background: var(--panel); }
        .wrap { display: grid; grid-template-columns: 1.15fr 1fr; min-height: 100vh; }
        .left { background: var(--bg); padding: 56px 100px 40px; display: flex; flex-direction: column; justify-content: center; gap: 22px;
                background-image: radial-gradient(#cfd8d2 1px, transparent 1px); background-size: 22px 22px; }
        :root[data-theme="dark"] .left { background-image: radial-gradient(#22332a 1px, transparent 1px); }
        .brand { display: flex; align-items: center; gap: 14px; font-weight: 700; font-size: 20px; }
        .brand .logo { width: 56px; height: 56px; border-radius: 14px; background: var(--brand); display: grid; place-items: center; }
        .brand svg { width: 30px; height: 30px; stroke: #fff; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .home { width: 124px; height: 124px; border-radius: 28px; background: var(--card); display: grid; place-items: center; box-shadow: 0 8px 24px #0001; }
        .home svg { width: 64px; height: 64px; stroke: var(--brand); fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
        h1.title { font-size: 42px; margin: 0; letter-spacing: -.02em; }
        .sub { font-size: 24px; color: var(--brand); font-weight: 500; margin: 0; }
        .desc { font-size: 17px; line-height: 1.65; color: var(--muted); max-width: 640px; margin: 0; }
        .stats { display: flex; gap: 20px; }
        .stat { background: var(--card); border: 1px solid var(--line); border-radius: 18px; padding: 18px 22px; min-width: 190px; }
        .stat small { color: var(--muted); display: block; font-size: 14px; }
        .stat b { font-size: 20px; }
        .copy { font-size: 14px; color: var(--muted); margin-top: 6px; }
        .right { position: relative; padding: 60px 70px; display: flex; flex-direction: column; justify-content: center; background: var(--panel); }
        .theme { position: absolute; top: 28px; right: 32px; width: 58px; height: 58px; border-radius: 50%; border: 1px solid var(--line);
                 background: var(--panel); color: var(--ink); cursor: pointer; display: grid; place-items: center; box-shadow: 0 4px 14px #0001; }
        .theme svg { width: 24px; height: 24px; stroke: currentColor; fill: none; stroke-width: 2; }
        h2 { font-size: 40px; margin: 0 0 8px; letter-spacing: -.02em; }
        .hint { color: var(--muted); font-size: 18px; margin: 0 0 36px; }
        label.lbl { font-weight: 600; display: block; margin: 0 0 10px; }
        .field { position: relative; margin-bottom: 26px; }
        .field > svg.ico { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); width: 22px; height: 22px; stroke: var(--muted); fill: none; stroke-width: 1.8; }
        .field input[type=text], .field input[type=password] {
            width: 100%; height: 68px; border-radius: 18px; border: 1px solid var(--line); background: var(--field);
            padding: 0 56px 0 58px; font: inherit; font-size: 17px; color: var(--ink); }
        .field input:focus { outline: 2px solid var(--brand); outline-offset: 2px; background: var(--panel); border-color: var(--brand); }
        .field.has-error input { border-color: var(--error); }
        .eye { position: absolute; right: 18px; top: 50%; transform: translateY(-50%); background: none; border: 0; cursor: pointer; color: var(--muted); padding: 6px; }
        .eye svg { width: 24px; height: 24px; stroke: currentColor; fill: none; stroke-width: 1.8; }
        .err { color: var(--error); font-size: 14px; margin: -16px 0 22px; }
        .ok { background: #e7f5ea; color: #1f5f2c; border-radius: 12px; padding: 12px 16px; margin-bottom: 22px; font-size: 14px; }
        :root[data-theme="dark"] .ok { background: #16301e; color: #a6e3b3; }
        .row { display: flex; justify-content: space-between; align-items: center; margin: -4px 0 30px; }
        .row label { display: flex; align-items: center; gap: 12px; cursor: pointer; }
        .row input[type=checkbox] { width: 22px; height: 22px; accent-color: var(--brand); }
        .row a { color: var(--ink); font-weight: 500; text-decoration: none; }
        .row a:hover { text-decoration: underline; }
        .btn { width: 100%; height: 76px; border: 0; border-radius: 20px; background: var(--brand); color: #fff; font: inherit; font-weight: 700;
               font-size: 21px; cursor: pointer; box-shadow: 0 10px 22px #3b5a3d44; transition: background .15s; }
        .btn:hover { background: var(--brand-dark); }
        .btn:focus-visible { outline: 3px solid var(--ink); outline-offset: 3px; }
        .foot { border-top: 1px solid var(--line); margin-top: 44px; padding-top: 38px; text-align: center; color: var(--muted); font-size: 15px; }
        @media (max-width: 900px) {
            .wrap { grid-template-columns: 1fr; }
            .left { display: none; }
            .right { padding: 70px 24px 40px; }
        }
    </style>
</head>
<body>
<div class="wrap">

    {{-- ===== Sisi kiri ===== --}}
    <section class="left">
        <div class="brand">
            <span class="logo">
                <svg viewBox="0 0 24 24"><path d="M14 4v10.5a4 4 0 1 1-4 0V4a2 2 0 0 1 4 0Z"/><path d="M4 6h3M4 10h3M4 14h3"/></svg>
            </span>
            SmartClassroom
        </div>
        <div class="home">
            <svg viewBox="0 0 24 24"><path d="M3 11 12 3l5 4.5M5 10v10h8"/><path d="M17 9v8"/><circle cx="17" cy="19" r="2"/></svg>
        </div>
        <h1 class="title">SmartClassroom</h1>
        <p class="sub">Monitoring Suhu Ruangan</p>
        <p class="desc">Sistem pemantauan dan kontrol suhu ruangan kelas cerdas berbasis IoT. Wujudkan lingkungan belajar yang nyaman dan kondusif secara akurat dan efisien.</p>
        <div class="stats">
            <div class="stat"><small>Suhu Rata-rata</small><b>24.5 °C</b></div>
            <div class="stat"><small>Kelembapan</small><b>58 %</b></div>
        </div>
        <div class="copy">© 2026 SmartClassroom IoT System. All rights reserved.</div>
    </section>

    {{-- ===== Sisi kanan: form login guru ===== --}}
    <section class="right">
        <button type="button" class="theme" id="themeBtn" aria-label="Ganti mode terang atau gelap">
            <svg viewBox="0 0 24 24"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"/></svg>
        </button>

        <h2>Masuk</h2>
        <p class="hint">Masukkan NIP untuk mengakses akun Anda</p>

        @if (session('status'))
            <div class="ok" role="status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login.proses') }}" autocomplete="off">
            @csrf

            <label class="lbl" for="nip">NIP</label>
            <div class="field {{ $errors->has('nip') ? 'has-error' : '' }}">
                <svg class="ico" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                <input type="text" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP" inputmode="numeric" required autofocus>
            </div>
            @error('nip') <p class="err">{{ $message }}</p> @enderror

            <label class="lbl" for="password">Kata Sandi</label>
            <div class="field {{ $errors->has('password') ? 'has-error' : '' }}">
                <svg class="ico" viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="3"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                <button type="button" class="eye" id="eyeBtn" aria-label="Tampilkan atau sembunyikan kata sandi">
                    <svg viewBox="0 0 24 24"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
            @error('password') <p class="err">{{ $message }}</p> @enderror

            <div class="row">
                <label><input type="checkbox" name="remember" value="1"> Ingat saya</label>
                <a href="#">Lupa kata sandi?</a>
            </div>

            <button type="submit" class="btn">Masuk &rarr;</button>
        </form>

        <div class="foot">Akses diberikan sesuai hak akses akun</div>
    </section>
</div>

<script>
    // Tampilkan / sembunyikan kata sandi
    document.getElementById('eyeBtn').addEventListener('click', function () {
        var f = document.getElementById('password');
        f.type = f.type === 'password' ? 'text' : 'password';
    });

    // Mode terang / gelap (disimpan di browser, dibungkus try/catch)
    var root = document.documentElement;
    try { if (localStorage.getItem('tema') === 'dark') root.setAttribute('data-theme', 'dark'); } catch (e) {}
    document.getElementById('themeBtn').addEventListener('click', function () {
        var dark = root.getAttribute('data-theme') === 'dark';
        if (dark) root.removeAttribute('data-theme'); else root.setAttribute('data-theme', 'dark');
        try { localStorage.setItem('tema', dark ? 'light' : 'dark'); } catch (e) {}
    });
</script>
</body>
</html>