@extends('PetugasTU.app')

@section('title', 'Kelola Ruangan')

@section('content')
    <style>
        .head-left { display: flex; align-items: center; gap: 14px; }
        .back { display: grid; place-items: center; width: 42px; height: 42px; border-radius: 12px; color: var(--forest); border: 1px solid var(--line); background: var(--card); }
        .back:hover { background: var(--sage); }

        .ruang-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 14px; }
        .ruang-card { display: grid; grid-template-columns: auto 1fr auto auto; align-items: center; gap: 14px; padding: 16px 18px; background: var(--card); border: 1px solid var(--line); border-radius: var(--radius); }
        .avatar-ruang { display: grid; place-items: center; width: 48px; height: 48px; border-radius: 50%; background: #E1E2D0; color: var(--forest); }
        .ruang-info { min-width: 0; }
        .ruang-info h2 { font: 700 1.0625rem/1.3 var(--font-head); overflow-wrap: anywhere; }
        .ruang-info p { font-size: .875rem; color: var(--mute); }
        .badge-aktif { background: #D4E6D8; color: var(--forest); }
        .badge-nonaktif { background: #E8E7E1; color: var(--mute); }

        .aksi { display: flex; gap: 2px; }
        .aksi button { display: grid; place-items: center; width: 36px; height: 36px; border: 0; background: transparent; color: var(--mute); border-radius: 10px; cursor: pointer; }
        .aksi .btn-edit:hover { background: var(--sage); color: var(--forest); }
        .aksi .btn-trash:hover { background: var(--brick-bg); color: var(--brick); }

        .dialog .confirm-text { margin-top: 12px; color: var(--mute); }
        .btn-hapus { background: var(--brick); border-color: var(--brick); color: #fff; }
        .btn-hapus:hover { background: #82331F; border-color: #82331F; }

        @media (max-width: 520px) {
            .ruang-list { grid-template-columns: 1fr; }
            .ruang-card { grid-template-columns: auto 1fr auto; }
            .ruang-card .aksi { grid-column: 1 / -1; justify-content: flex-end; }
        }
    </style>

    <header class="page-head">
        <div class="head-left">
            <a href="{{ route('tu.beranda') }}" class="back" aria-label="Kembali ke Beranda">
                <svg class="ic"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
            </a>
            <div>
                <h1>Kelola Ruangan</h1>
                <p id="jumlah">{{ count($ruangan) }} ruangan terdaftar.</p>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-add>
            <svg class="ic ic-18"><use href="#i-plus"/></svg> Tambah ruangan
        </button>
    </header>

    <div class="toolbar">
        <label class="search">
            <svg class="ic ic-18"><use href="#i-search"/></svg>
            <input type="search" placeholder="Cari nama kelas..." data-search aria-label="Cari ruangan">
        </label>
        <div class="chips" role="group" aria-label="Filter status">
            @foreach (['Semua', 'Aktif', 'Nonaktif'] as $i => $s)
                <button type="button" class="chip {{ $i === 0 ? 'is-on' : '' }}" data-chip="{{ $s }}">{{ $s }}</button>
            @endforeach
        </div>
    </div>

    <div class="ruang-list" data-list>
        @foreach ($ruangan as $r)
            @php
                $aktif = $r['status'] !== 'Perawatan';
                $label = $aktif ? 'Aktif' : 'Nonaktif';
            @endphp
            <article class="ruang-card" data-item
                     data-status="{{ $label }}"
                     data-text="{{ strtolower($r['nama']) }}"
                     data-nama="{{ $r['nama'] }}" data-lantai="{{ $r['lantai'] }}"
                     data-kapasitas="{{ $r['kapasitas'] }}">
                <span class="avatar-ruang"><svg class="ic"><use href="#i-building"/></svg></span>
                <div class="ruang-info">
                    <h2>{{ $r['nama'] }}</h2>
                    <p>Kapasitas: {{ $r['kapasitas'] }} orang</p>
                </div>
                <span class="badge {{ $aktif ? 'badge-aktif' : 'badge-nonaktif' }}">{{ $label }}</span>
                <div class="aksi">
                    <button type="button" class="btn-edit" data-edit aria-label="Edit {{ $r['nama'] }}" title="Edit">
                        <svg class="ic ic-20"><path d="M4 20h4L19 9l-4-4L4 16v4zM13.5 6.5l4 4"/></svg>
                    </button>
                    <button type="button" class="btn-trash" data-hapus aria-label="Hapus {{ $r['nama'] }}" title="Hapus">
                        <svg class="ic ic-20"><path d="M4 7h16M10 11v6M14 11v6M6 7l1 12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1l1-12M9 7V4h6v3"/></svg>
                    </button>
                </div>
            </article>
        @endforeach
    </div>

    <p class="empty" data-empty hidden>Tidak ada ruangan yang cocok. Ubah kata kunci atau filter status.</p>

    {{-- Form tambah / edit --}}
    <dialog id="dlg-ruang-form" class="dialog">
        <form method="dialog" id="form-ruang" data-demo-form data-toast="Data ruangan disimpan">
            <header>
                <h2 id="judul-form">Tambah ruangan</h2>
                <button type="button" class="icon-btn" data-close aria-label="Tutup"><svg class="ic ic-20"><use href="#i-close"/></svg></button>
            </header>
            <div class="fields">
                <label>Nama ruangan
                    <input type="text" name="nama" required placeholder="Contoh: X IPA 3">
                </label>
                <div class="fields-2">
                    <label>Lantai
                        <input type="number" name="lantai" min="1" value="1" required>
                    </label>
                    <label>Kapasitas (orang)
                        <input type="number" name="kapasitas" min="1" value="30" required>
                    </label>
                </div>
                <label>Status
                    <select name="status">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                </label>
            </div>
            <footer>
                <button type="button" class="btn" data-close>Batal</button>
                <button type="submit" class="btn btn-primary" id="submit-form">Simpan ruangan</button>
            </footer>
        </form>
    </dialog>

    {{-- Konfirmasi hapus --}}
    <dialog id="dlg-hapus" class="dialog">
        <form method="dialog" onsubmit="return false;">
            <header>
                <h2>Hapus ruangan?</h2>
                <button type="button" class="icon-btn" data-close aria-label="Tutup"><svg class="ic ic-20"><use href="#i-close"/></svg></button>
            </header>
            <p class="confirm-text">Data <strong id="hapus-nama"></strong> akan dihapus dari daftar.</p>
            <footer>
                <button type="button" class="btn" data-close>Batal</button>
                <button type="button" class="btn btn-hapus" id="konfirmasi-hapus">Hapus ruangan</button>
            </footer>
        </form>
    </dialog>

    <script>
        (function () {
            var form = document.getElementById('form-ruang');
            var dlgForm = document.getElementById('dlg-ruang-form');
            var dlgHapus = document.getElementById('dlg-hapus');
            var judul = document.getElementById('judul-form');
            var submit = document.getElementById('submit-form');
            var namaHapus = document.getElementById('hapus-nama');
            var jumlah = document.getElementById('jumlah');
            var toastEl = document.getElementById('toast');
            var target = null, timer;

            function note(msg) {
                toastEl.textContent = msg;
                toastEl.classList.add('is-show');
                clearTimeout(timer);
                timer = setTimeout(function () { toastEl.classList.remove('is-show'); }, 2600);
            }

            document.querySelector('[data-add]').addEventListener('click', function () {
                form.reset();
                judul.textContent = 'Tambah ruangan';
                submit.textContent = 'Simpan ruangan';
                form.dataset.toast = 'Ruangan ditambahkan';
                dlgForm.showModal();
            });

            document.querySelectorAll('[data-edit]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var c = btn.closest('[data-item]');
                    form.elements['nama'].value = c.dataset.nama;
                    form.elements['lantai'].value = c.dataset.lantai;
                    form.elements['kapasitas'].value = c.dataset.kapasitas;
                    form.elements['status'].value = c.dataset.status;
                    judul.textContent = 'Edit ruangan';
                    submit.textContent = 'Simpan perubahan';
                    form.dataset.toast = 'Perubahan ruangan disimpan';
                    dlgForm.showModal();
                });
            });

            document.querySelectorAll('[data-hapus]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    target = btn.closest('[data-item]');
                    namaHapus.textContent = target.dataset.nama;
                    dlgHapus.showModal();
                });
            });

            document.getElementById('konfirmasi-hapus').addEventListener('click', function () {
                if (target) target.remove();
                target = null;
                dlgHapus.close();
                var sisa = document.querySelectorAll('[data-item]').length;
                jumlah.textContent = sisa + ' ruangan terdaftar.';
                if (sisa === 0) document.querySelector('[data-empty]').hidden = false;
                note('Ruangan dihapus');
            });
        })();
    </script>
@endsection