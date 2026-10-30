@extends('PetugasTU.app')

@section('title', 'Profil')

@section('content')
    <style>
        .avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; display: block; }
        .avatar { overflow: hidden; }
        .foto-btn { position: relative; display: block; width: 84px; height: 84px; padding: 0; border: 0; border-radius: 50%; background: none; cursor: pointer; }
        .foto-btn .avatar-lg { margin-bottom: 0; }
        .foto-badge {
            position: absolute; right: -4px; bottom: -4px;
            display: grid; place-items: center; width: 32px; height: 32px;
            border-radius: 50%; background: var(--card); color: var(--forest);
            border: 1px solid var(--line); box-shadow: 0 2px 6px rgba(28,41,33,.15);
            transition: background .15s, color .15s;
        }
        .foto-btn:hover .foto-badge, .foto-btn:focus-visible .foto-badge { background: var(--forest); color: #fff; border-color: var(--forest); }
        .profile-card h2 { margin-top: 14px; }
        .form-profil { display: grid; gap: 16px; margin-top: 16px; }
        .form-profil input { height: 46px; padding: 0 14px; width: 100%; border: 1px solid var(--line); border-radius: 10px; background: #fff; font-weight: 400; }
        .form-profil input:focus { outline: 3px solid rgba(125,155,133,.45); border-color: var(--forest-2); }
        .form-profil input.is-error { border-color: var(--brick); }
        small.err { color: var(--brick); font-weight: 500; }
    </style>

    <header class="page-head">
        <div>
            <h1>Profil</h1>
            <p>Kelola informasi akun Anda.</p>
        </div>
    </header>

    <div class="two-col two-col-profile">
        <section class="panel profile-card">
            {{-- Foto: langsung tersimpan begitu dipilih --}}
            <form id="form-foto" method="POST" action="{{ route('tu.profil.foto') }}" enctype="multipart/form-data">
                @csrf
                <button type="button" class="foto-btn" id="pilih-foto" aria-label="Ganti foto profil" title="Ganti foto (JPG, PNG, WEBP, maks. 2 MB)">
                    <span class="avatar avatar-lg">
                        @if ($akun['foto'])
                            <img src="{{ $akun['foto'] }}" alt="Foto profil {{ $akun['nama'] }}">
                        @else
                            {{ $akun['inisial'] }}
                        @endif
                    </span>
                    <span class="foto-badge" aria-hidden="true">
                        <svg class="ic ic-18"><path d="M4 8h3l2-2.5h6L17 8h3a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/><circle cx="12" cy="13" r="3.5"/></svg>
                    </span>
                </button>
                <input type="file" name="foto" id="input-foto" accept="image/png,image/jpeg,image/webp" hidden>
            </form>
            @error('foto') <small class="err">{{ $message }}</small> @enderror

            <h2>{{ $akun['nama'] }}</h2>
            <p class="muted">{{ $akun['peran'] }}</p>
            <p class="muted">{{ $akun['sekolah'] }}</p>

            <form method="POST" action="{{ route('tu.keluar') }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <svg class="ic ic-18"><use href="#i-logout"/></svg> Keluar
                </button>
            </form>
        </section>

        <section class="panel">
            <h2 class="section-title">Informasi akun</h2>
            <form method="POST" action="{{ route('tu.profil.update') }}" class="form-profil">
                @csrf
                @method('PUT')
                <label>Nama lengkap
                    <input type="text" name="nama" value="{{ old('nama', $akun['nama']) }}" class="{{ $errors->has('nama') ? 'is-error' : '' }}" required>
                    @error('nama') <small class="err">{{ $message }}</small> @enderror
                </label>
                <label>Email
                    <input type="email" name="email" value="{{ old('email', $akun['email']) }}" class="{{ $errors->has('email') ? 'is-error' : '' }}" required>
                    @error('email') <small class="err">{{ $message }}</small> @enderror
                </label>
                <label>Nomor telepon
                    <input type="tel" name="telepon" value="{{ old('telepon', $akun['telepon']) }}">
                    @error('telepon') <small class="err">{{ $message }}</small> @enderror
                </label>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </div>
            </form>
        </section>
    </div>

    <script>
        (function () {
            var toastEl = document.getElementById('toast'), timer;
            function note(msg) {
                toastEl.textContent = msg;
                toastEl.classList.add('is-show');
                clearTimeout(timer);
                timer = setTimeout(function () { toastEl.classList.remove('is-show'); }, 3000);
            }

            var input = document.getElementById('input-foto');
            document.getElementById('pilih-foto').addEventListener('click', function () { input.click(); });
            input.addEventListener('change', function () {
                if (!input.files.length) return;
                if (input.files[0].size > 2 * 1024 * 1024) {
                    note('Ukuran foto maksimal 2 MB.');
                    input.value = '';
                    return;
                }
                document.getElementById('form-foto').submit();
            });

            @if (session('sukses'))
                note(@json(session('sukses')));
            @endif
        })();
    </script>
@endsection