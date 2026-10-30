<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk · SmartClassroom</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --paper: #F3F5EE; --card: #FBFCF8; --sage: #E3EADD; --line: #D3DCCB;
            --forest: #2A4838; --forest-2: #3C6150; --moss: #7D9B85;
            --ink: #1C2921; --mute: #627166; --brick: #9B3F2E; --brick-bg: #F4DDD6;
            --font-head: "Bricolage Grotesque", "Segoe UI", sans-serif;
            --font-body: "Figtree", "Segoe UI", system-ui, sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; background: var(--paper); color: var(--ink); font: 400 16px/1.55 var(--font-body); }
        h1, h2, p { margin: 0; }
        button, input { font: inherit; color: inherit; }
        a { color: inherit; text-decoration: none; }
        :focus-visible { outline: 3px solid var(--moss); outline-offset: 2px; border-radius: 6px; }
        [hidden] { display: none !important; }

        .portal { display: grid; grid-template-columns: 1.1fr 1fr; min-height: 100vh; }

        /* ----- Sisi kiri: merek ----- */
        .merek { position: relative; overflow: hidden; background: var(--forest); color: #fff; display: flex; flex-direction: column; justify-content: center; padding: 64px clamp(32px, 6vw, 88px) 200px; }
        .logo { display: flex; align-items: center; gap: 12px; position: absolute; top: 40px; left: clamp(32px, 6vw, 88px); font: 700 1.125rem var(--font-head); }
        .logo-mark { display: grid; place-items: center; width: 40px; height: 40px; border-radius: 12px; background: rgba(255,255,255,.14); }
        .merek h1 { font: 700 clamp(2.25rem, 4.4vw, 3.5rem)/1.08 var(--font-head); letter-spacing: -.02em; max-width: 12ch; }
        .merek p { margin-top: 18px; max-width: 42ch; color: #D6E4D9; font-size: 1.0625rem; }
        .wave { position: absolute; left: 0; bottom: -1px; width: 100%; height: 170px; display: block; }
        .wave-1 { fill: #36594A; } .wave-2 { fill: #476E5B; } .wave-3 { fill: #5E8570; }

        /* ----- Sisi kanan: masuk ----- */
        .masuk { display: grid; place-items: center; padding: 40px 24px; }
        .kartu { width: 100%; max-width: 440px; }
        .kartu h2 { font: 700 2rem/1.15 var(--font-head); letter-spacing: -.01em; }
        .kartu > p { margin-top: 6px; color: var(--mute); }

        .info { margin-top: 20px; padding: 12px 16px; border-radius: 12px; background: var(--sage); color: var(--forest); font-weight: 500; }

        .peran { display: grid; grid-template-columns: 1fr 1fr; gap: 6px; margin-top: 26px; padding: 6px; background: var(--sage); border-radius: 14px; }
        .peran button { height: 46px; border: 0; border-radius: 10px; background: transparent; color: var(--mute); font-weight: 600; cursor: pointer; transition: background .15s, color .15s; }
        .peran button:hover { color: var(--ink); }
        .peran button[aria-selected="true"] { background: var(--forest); color: #fff; }

        .panel { margin-top: 26px; }
        .panel .teks { color: var(--mute); margin-bottom: 20px; }

        form { display: grid; gap: 18px; }
        label { display: grid; gap: 6px; font-weight: 600; font-size: .9375rem; }
        .kolom { position: relative; }
        input { width: 100%; height: 48px; padding: 0 14px; border: 1px solid var(--line); border-radius: 12px; background: #fff; font-weight: 400; }
        input:focus { outline: 3px solid rgba(125,155,133,.45); border-color: var(--forest-2); }
        input.is-error { border-color: var(--brick); }
        .kolom input { padding-right: 76px; }
        .lihat { position: absolute; right: 8px; top: 50%; transform: translateY(-50%); height: 34px; padding: 0 12px; border: 0; border-radius: 8px; background: transparent; color: var(--forest-2); font-weight: 600; font-size: .875rem; cursor: pointer; }
        .lihat:hover { background: var(--sage); }
        .err { color: var(--brick); font-weight: 500; font-size: .875rem; }

        .btn { display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 50px; border: 0; border-radius: 12px; background: var(--forest); color: #fff; font-weight: 600; cursor: pointer; transition: background .15s; }
        .btn:hover { background: var(--forest-2); }
        .catatan { margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--line); color: var(--mute); font-size: .875rem; text-align: center; }

        @media (max-width: 900px) {
            .portal { grid-template-columns: 1fr; }
            .merek { padding: 110px 28px 120px; }
            .merek h1 { max-width: none; }
            .wave { height: 90px; }
            .logo { top: 28px; left: 28px; }
        }
        @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
    </style>
</head>
<body>
    @php
        $tabAktif = ($errors->any() || request('peran') === 'tu') ? 'tu' : 'guru';
    @endphp

    <main class="portal">
        <section class="merek">
            <div class="logo">
                <span class="logo-mark">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="3" width="14" height="18" rx="1"/><path d="M9 7h2M13 7h2M9 11h2M13 11h2M10 21v-4h4v4"/></svg>
                </span>
                SmartClassroom
            </div>

            <h1>Monitoring suhu ruangan kelas</h1>
            <p>Pantau kondisi ruangan, atur data kelas dan guru, serta lihat riwayatnya dalam satu tempat.</p>

            <svg class="wave" viewBox="0 0 1200 160" preserveAspectRatio="none" aria-hidden="true">
                <path class="wave-1" d="M0 70 C200 20 380 120 600 80 C820 40 1000 110 1200 60 L1200 160 L0 160 Z"/>
                <path class="wave-2" d="M0 100 C220 60 400 140 620 108 C840 76 1020 132 1200 96 L1200 160 L0 160 Z"/>
                <path class="wave-3" d="M0 128 C240 100 420 154 640 132 C860 110 1040 150 1200 124 L1200 160 L0 160 Z"/>
            </svg>
        </section>

        <section class="masuk">
            <div class="kartu">
                <h2>Masuk</h2>
                <p>Pilih peran Anda untuk melanjutkan.</p>

                @if (session('info'))
                    <p class="info" role="status">{{ session('info') }}</p>
                @endif

                <div class="peran" role="tablist" aria-label="Pilih peran">
                    <button type="button" role="tab" id="tab-guru" aria-controls="panel-guru" aria-selected="{{ $tabAktif === 'guru' ? 'true' : 'false' }}">Guru</button>
                    <button type="button" role="tab" id="tab-tu" aria-controls="panel-tu" aria-selected="{{ $tabAktif === 'tu' ? 'true' : 'false' }}">Petugas TU</button>
                </div>

                {{-- Guru: memakai halaman login yang sudah ada --}}
                <div class="panel" id="panel-guru" role="tabpanel" aria-labelledby="tab-guru" @if ($tabAktif !== 'guru') hidden @endif>
                    <p class="teks">Guru masuk menggunakan NIP dan kata sandi dari akun yang dibuat oleh Petugas TU.</p>
                    <a href="{{ url('/login') }}" class="btn">Lanjut masuk sebagai Guru</a>
                </div>

                {{-- Petugas TU --}}
                <div class="panel" id="panel-tu" role="tabpanel" aria-labelledby="tab-tu" @if ($tabAktif !== 'tu') hidden @endif>
                    <form method="POST" action="{{ route('tu.login.proses') }}">
                        @csrf
                        <label>
                            Email
                            <input type="email" name="email" value="{{ old('email') }}" autocomplete="username" placeholder="Masukkan email Petugas TU" class="{{ $errors->has('email') ? 'is-error' : '' }}" required>
                            @error('email') <span class="err">{{ $message }}</span> @enderror
                        </label>
                        <label>
                            Kata sandi
                            <span class="kolom">
                                <input type="password" name="password" id="sandi" autocomplete="current-password" placeholder="Masukkan kata sandi" class="{{ $errors->has('password') ? 'is-error' : '' }}" required>
                                <button type="button" class="lihat" id="lihat" aria-controls="sandi">Lihat</button>
                            </span>
                            @error('password') <span class="err">{{ $message }}</span> @enderror
                        </label>
                        <button type="submit" class="btn">Masuk sebagai Petugas TU</button>
                    </form>
                </div>

                <p class="catatan">Akses diberikan sesuai hak akses akun.</p>
            </div>
        </section>
    </main>

    <script>
        (function () {
            var tabs = { guru: document.getElementById('tab-guru'), tu: document.getElementById('tab-tu') };
            var panels = { guru: document.getElementById('panel-guru'), tu: document.getElementById('panel-tu') };

            function pilih(nama) {
                Object.keys(tabs).forEach(function (k) {
                    tabs[k].setAttribute('aria-selected', k === nama ? 'true' : 'false');
                    panels[k].hidden = k !== nama;
                });
            }
            tabs.guru.addEventListener('click', function () { pilih('guru'); });
            tabs.tu.addEventListener('click', function () { pilih('tu'); });

            var sandi = document.getElementById('sandi');
            var lihat = document.getElementById('lihat');
            lihat.addEventListener('click', function () {
                var tampil = sandi.type === 'password';
                sandi.type = tampil ? 'text' : 'password';
                lihat.textContent = tampil ? 'Sembunyikan' : 'Lihat';
            });
        })();
    </script>
</body>
</html>