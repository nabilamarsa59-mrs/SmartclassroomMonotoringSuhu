@extends('PetugasTU.app')

@section('title', 'Kelola Guru')

@section('content')
    @php
        // Kalau validasi gagal, form dibuka lagi pada mode yang sama (tambah / edit)
        $editId = old('guru_id');
    @endphp

    <style>
        .head-left { display: flex; align-items: center; gap: 14px; }
        .back { display: grid; place-items: center; width: 42px; height: 42px; border-radius: 12px; color: var(--forest); border: 1px solid var(--line); background: var(--card); cursor: pointer; }
        .back:hover { background: var(--sage); }

        .guru-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 14px; }
        .guru-row { display: grid; grid-template-columns: auto 1fr auto auto; align-items: center; gap: 14px; padding: 16px 18px; background: var(--card); border: 1px solid var(--line); border-radius: var(--radius); }
        .avatar-guru { display: grid; place-items: center; width: 48px; height: 48px; border-radius: 50%; background: #E1E2D0; color: var(--forest); }
        .guru-info { min-width: 0; }
        .guru-info h2 { font: 700 1.0625rem/1.3 var(--font-head); overflow-wrap: anywhere; }
        .guru-info p { font-size: .875rem; color: var(--mute); }
        .badge-aktif { background: #D4E6D8; color: var(--forest); }
        .badge-nonaktif { background: #E8E7E1; color: var(--mute); }

        .aksi { display: flex; gap: 2px; }
        .aksi button { display: grid; place-items: center; width: 36px; height: 36px; border: 0; background: transparent; color: var(--mute); border-radius: 10px; cursor: pointer; }
        .aksi .btn-edit:hover { background: var(--sage); color: var(--forest); }
        .aksi .btn-trash:hover { background: var(--brick-bg); color: var(--brick); }

        .form-wrap { max-width: 520px; margin-inline: auto; }
        .form-card { display: grid; gap: 18px; }
        .form-card input, .form-card select {
            height: 46px; padding: 0 14px; width: 100%;
            border: 1px solid var(--line); border-radius: 10px; background: #fff; font-weight: 400;
        }
        .form-card input:focus, .form-card select:focus { outline: 3px solid rgba(125,155,133,.45); border-color: var(--forest-2); }
        .form-card input.is-error { border-color: var(--brick); }
        .form-card small.err { color: var(--brick); font-weight: 500; }
        .form-card small.hint { color: var(--mute); font-weight: 400; }
        .req { color: var(--brick); }
        .form-card .btn { width: 100%; }
        .form-btns { display: grid; gap: 12px; margin-top: 6px; }

        .dialog .confirm-text { margin-top: 12px; color: var(--mute); }
        .btn-hapus { background: var(--brick); border-color: var(--brick); color: #fff; }
        .btn-hapus:hover { background: #82331F; border-color: #82331F; }

        @media (max-width: 520px) {
            .guru-list { grid-template-columns: 1fr; }
            .guru-row { grid-template-columns: auto 1fr auto; }
            .guru-row .aksi { grid-column: 1 / -1; justify-content: flex-end; }
            .page-head .btn { width: auto; }
        }
    </style>

    {{-- ===== Layar 1: Daftar guru ===== --}}
    <section id="layar-daftar" @if ($errors->any()) hidden @endif>
        <header class="page-head">
            <div class="head-left">
                <a href="{{ route('tu.beranda') }}" class="back" aria-label="Kembali ke Beranda">
                    <svg class="ic"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
                </a>
                <h1>Kelola Guru</h1>
            </div>
            <button type="button" class="btn btn-primary" id="btn-tambah">
                <svg class="ic ic-18"><use href="#i-plus"/></svg> Tambah guru
            </button>
        </header>

        <div class="toolbar">
            <label class="search">
                <svg class="ic ic-18"><use href="#i-search"/></svg>
                <input type="search" id="cari" placeholder="Cari nama atau NIP..." aria-label="Cari guru">
            </label>
            <div class="chips" role="group" aria-label="Filter status">
                @foreach (['Semua', 'Aktif', 'Nonaktif'] as $i => $s)
                    <button type="button" class="chip {{ $i === 0 ? 'is-on' : '' }}" data-filter="{{ $s }}">{{ $s }}</button>
                @endforeach
            </div>
        </div>

        <div class="guru-list" id="daftar">
            @foreach ($guru as $g)
                @php $aktif = $g['status'] === 'Aktif'; @endphp
                <article class="guru-row"
                         data-id="{{ $g['id'] }}"
                         data-nama="{{ $g['nama'] }}"
                         data-nip="{{ $g['nip'] }}"
                         data-email="{{ $g['email'] }}"
                         data-telepon="{{ $g['telepon'] }}"
                         data-status="{{ $aktif ? 'Aktif' : 'Nonaktif' }}"
                         data-text="{{ strtolower($g['nama'].' '.$g['nip']) }}">
                    <span class="avatar-guru"><svg class="ic"><use href="#i-user"/></svg></span>
                    <div class="guru-info">
                        <h2>{{ $g['nama'] }}</h2>
                        <p>NIP {{ $g['nip'] }}</p>
                    </div>
                    <span class="badge {{ $aktif ? 'badge-aktif' : 'badge-nonaktif' }}">{{ $aktif ? 'Aktif' : 'Nonaktif' }}</span>
                    <div class="aksi">
                        <button type="button" class="btn-edit" aria-label="Edit {{ $g['nama'] }}" title="Edit">
                            <svg class="ic ic-20"><path d="M4 20h4L19 9l-4-4L4 16v4zM13.5 6.5l4 4"/></svg>
                        </button>
                        <button type="button" class="btn-trash" aria-label="Hapus {{ $g['nama'] }}" title="Hapus">
                            <svg class="ic ic-20"><path d="M4 7h16M10 11v6M14 11v6M6 7l1 12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1l1-12M9 7V4h6v3"/></svg>
                        </button>
                    </div>
                </article>
            @endforeach
        </div>

        <p class="empty" id="kosong" @if (count($guru)) hidden @endif>
            Belum ada guru yang cocok atau terdaftar. Klik Tambah guru untuk menambahkan.
        </p>
    </section>

    {{-- ===== Layar 2: Tambah / Edit guru ===== --}}
    <section id="layar-form" @unless ($errors->any()) hidden @endunless>
        <div class="form-wrap">
            <header class="page-head">
                <div class="head-left">
                    <button type="button" class="back" data-batal aria-label="Kembali ke daftar guru">
                        <svg class="ic"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
                    </button>
                    <h1 id="judul-form">Tambah Guru</h1>
                </div>
            </header>

            <form id="form-guru" class="form-card" method="POST" action="{{ route('tu.guru.store') }}">
                @csrf
                <input type="hidden" name="_method" value="PUT" id="field-method" disabled>
                <input type="hidden" name="guru_id" id="guru-id" value="{{ $editId }}">

                <label>
                    <span>NIP <span class="req">*</span></span>
                    <input type="text" name="nip" value="{{ old('nip') }}" inputmode="numeric" placeholder="Masukkan NIP" class="{{ $errors->has('nip') ? 'is-error' : '' }}" required>
                    @error('nip') <small class="err">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span>Nama <span class="req">*</span></span>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama guru" class="{{ $errors->has('nama') ? 'is-error' : '' }}" required>
                    @error('nama') <small class="err">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span>Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email (opsional)" class="{{ $errors->has('email') ? 'is-error' : '' }}">
                    @error('email') <small class="err">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span>No. Tlpn</span>
                    <input type="tel" name="telepon" value="{{ old('telepon') }}" placeholder="Masukkan no.tlpn (opsional)">
                </label>
                <label>
                    <span>Status</span>
                    <select name="status">
                        <option value="Aktif" @selected(old('status') === 'Aktif')>Aktif</option>
                        <option value="Nonaktif" @selected(old('status') === 'Nonaktif')>Nonaktif</option>
                    </select>
                </label>
                <label>
                    <span>Kata Sandi <span class="req" id="tanda-sandi">*</span></span>
                    <input type="password" name="sandi" id="field-sandi" placeholder="Buat kata sandi awal" class="{{ $errors->has('sandi') ? 'is-error' : '' }}" @unless ($editId) required @endunless>
                    <small class="hint" id="hint-sandi" hidden>Kosongkan jika tidak ingin mengganti kata sandi.</small>
                    @error('sandi') <small class="err">{{ $message }}</small> @enderror
                </label>

                <div class="form-btns">
                    <button type="submit" class="btn btn-primary" id="submit-form">Simpan Guru</button>
                    <button type="button" class="btn" data-batal>Batal</button>
                </div>
            </form>
        </div>
    </section>

    {{-- ===== Konfirmasi hapus ===== --}}
    <dialog id="dlg-hapus" class="dialog">
        <form method="POST" id="form-hapus" action="#">
            @csrf
            @method('DELETE')
            <header>
                <h2>Hapus guru?</h2>
                <button type="button" class="icon-btn" data-close aria-label="Tutup"><svg class="ic ic-20"><use href="#i-close"/></svg></button>
            </header>
            <p class="confirm-text">Data <strong id="hapus-nama"></strong> akan dihapus dan akunnya tidak bisa dipakai login lagi.</p>
            <footer>
                <button type="button" class="btn" data-close>Batal</button>
                <button type="submit" class="btn btn-hapus">Hapus guru</button>
            </footer>
        </form>
    </dialog>

    <script>
        (function () {
            var URL_TAMBAH = @json(route('tu.guru.store'));
            var URL_UBAH = @json(route('tu.guru.update', '__ID__'));
            var URL_HAPUS = @json(route('tu.guru.destroy', '__ID__'));

            var layarDaftar = document.getElementById('layar-daftar');
            var layarForm = document.getElementById('layar-form');
            var daftar = document.getElementById('daftar');
            var kosong = document.getElementById('kosong');
            var cari = document.getElementById('cari');
            var form = document.getElementById('form-guru');
            var judul = document.getElementById('judul-form');
            var submit = document.getElementById('submit-form');
            var fieldMethod = document.getElementById('field-method');
            var fieldId = document.getElementById('guru-id');
            var fieldSandi = document.getElementById('field-sandi');
            var tandaSandi = document.getElementById('tanda-sandi');
            var hintSandi = document.getElementById('hint-sandi');
            var chips = document.querySelectorAll('[data-filter]');
            var dlgHapus = document.getElementById('dlg-hapus');
            var toastEl = document.getElementById('toast');
            var status = 'Semua', timer;

            function note(msg) {
                toastEl.textContent = msg;
                toastEl.classList.add('is-show');
                clearTimeout(timer);
                timer = setTimeout(function () { toastEl.classList.remove('is-show'); }, 3500);
            }

            function terapkan() {
                var q = cari.value.trim().toLowerCase();
                var tampil = 0;
                daftar.querySelectorAll('.guru-row').forEach(function (el) {
                    var ok = (status === 'Semua' || el.dataset.status === status)
                          && (!q || el.dataset.text.indexOf(q) !== -1);
                    el.hidden = !ok;
                    if (ok) tampil++;
                });
                kosong.hidden = tampil !== 0;
            }

            function buka(layar) {
                layarDaftar.hidden = layar !== 'daftar';
                layarForm.hidden = layar !== 'form';
                window.scrollTo(0, 0);
            }

            // Mode form: tambah (POST) atau edit (PUT ke /tu/guru/{id})
            function aturMode(edit, id) {
                if (edit) {
                    judul.textContent = 'Edit Guru';
                    submit.textContent = 'Simpan perubahan';
                    form.action = URL_UBAH.replace('__ID__', id);
                    fieldMethod.disabled = false;
                    fieldId.value = id;
                    fieldSandi.required = false;
                    fieldSandi.placeholder = 'Kata sandi baru (opsional)';
                    tandaSandi.hidden = true;
                    hintSandi.hidden = false;
                } else {
                    judul.textContent = 'Tambah Guru';
                    submit.textContent = 'Simpan Guru';
                    form.action = URL_TAMBAH;
                    fieldMethod.disabled = true;
                    fieldId.value = '';
                    fieldSandi.required = true;
                    fieldSandi.placeholder = 'Buat kata sandi awal';
                    tandaSandi.hidden = false;
                    hintSandi.hidden = true;
                }
            }

            function bersihkanForm() {
                form.querySelectorAll('input:not([type=hidden])').forEach(function (i) { i.value = ''; });
                form.querySelectorAll('input.is-error').forEach(function (i) { i.classList.remove('is-error'); });
                form.querySelectorAll('small.err').forEach(function (s) { s.remove(); });
                form.elements['status'].selectedIndex = 0;
            }

            cari.addEventListener('input', terapkan);
            chips.forEach(function (chip) {
                chip.addEventListener('click', function () {
                    status = chip.dataset.filter;
                    chips.forEach(function (c) { c.classList.toggle('is-on', c === chip); });
                    terapkan();
                });
            });

            // Tambah
            document.getElementById('btn-tambah').addEventListener('click', function () {
                bersihkanForm();
                aturMode(false);
                buka('form');
                form.elements['nip'].focus();
            });

            // Edit & hapus (delegasi klik pada daftar)
            daftar.addEventListener('click', function (e) {
                var card = e.target.closest('.guru-row');
                if (!card) return;

                if (e.target.closest('.btn-edit')) {
                    bersihkanForm();
                    form.elements['nip'].value = card.dataset.nip;
                    form.elements['nama'].value = card.dataset.nama;
                    form.elements['email'].value = card.dataset.email;
                    form.elements['telepon'].value = card.dataset.telepon;
                    form.elements['status'].value = card.dataset.status;
                    aturMode(true, card.dataset.id);
                    buka('form');
                    form.elements['nama'].focus();
                }

                if (e.target.closest('.btn-trash')) {
                    document.getElementById('hapus-nama').textContent = card.dataset.nama;
                    document.getElementById('form-hapus').action = URL_HAPUS.replace('__ID__', card.dataset.id);
                    dlgHapus.showModal();
                }
            });

            document.querySelectorAll('[data-batal]').forEach(function (b) {
                b.addEventListener('click', function () { buka('daftar'); });
            });

            // Jika validasi gagal saat edit, form dibuka lagi dalam mode edit
            @if ($editId)
                aturMode(true, @json($editId));
            @endif

            @if (session('sukses'))
                note(@json(session('sukses')));
            @endif
        })();
    </script>
@endsection