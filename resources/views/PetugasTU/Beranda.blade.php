@extends('PetugasTU.app')

@section('title', 'Beranda')

@section('content')
    <style>
        .badge-aktif { background: #D4E6D8; color: var(--forest); }
        .badge-nonaktif { background: #E8E7E1; color: var(--mute); }

        .kondisi-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 12px; margin-top: 16px; }
        .kondisi-item {
            display: flex; justify-content: space-between; align-items: center; gap: 16px;
            padding: 14px 18px; background: var(--paper); border: 1px solid var(--line); border-radius: 12px;
        }
        .kondisi-item strong { display: block; font-weight: 600; }
    </style>

    <header class="page-head">
        <div>
            <h1>Halo, {{ $user['nama'] }}</h1>
            <p>{{ $user['peran'] }}</p>
        </div>
    </header>

    <section class="hero" aria-labelledby="hero-title">
        <div class="hero-body">
            <h2 id="hero-title">Kelola Data Sistem</h2>
            <p>Atur kelas, guru, dan pantauan kondisi ruangan.</p>
            <p class="hero-live">
                <span class="dot"></span>
                {{ $kelasAktif }} dari {{ $totalKelas }} kelas aktif
            </p>
        </div>
        <svg class="wave" viewBox="0 0 1200 160" preserveAspectRatio="none" aria-hidden="true">
            <path class="wave-1" d="M0 70 C200 20 380 120 600 80 C820 40 1000 110 1200 60 L1200 160 L0 160 Z"/>
            <path class="wave-2" d="M0 100 C220 60 400 140 620 108 C840 76 1020 132 1200 96 L1200 160 L0 160 Z"/>
            <path class="wave-3" d="M0 128 C240 100 420 154 640 132 C860 110 1040 150 1200 124 L1200 160 L0 160 Z"/>
        </svg>
    </section>

    <section class="panel" aria-labelledby="ringkasan">
        <h2 id="ringkasan" class="section-title">Ringkasan Sistem</h2>
        <dl class="stats">
            <div class="stat">
                <dt>Total kelas</dt>
                <dd>{{ $totalKelas }}</dd>
            </div>
            <div class="stat">
                <dt>Total guru</dt>
                <dd>{{ $totalGuru }}</dd>
            </div>
            <div class="stat">
                <dt>Kelas aktif</dt>
                <dd>{{ $kelasAktif }}</dd>
            </div>
        </dl>
    </section>

    <section class="panel" aria-labelledby="kondisi">
        <div class="panel-head">
            <h2 id="kondisi" class="section-title">Kondisi ruangan</h2>
            <a href="{{ route('tu.ruangan') }}" class="link">Lihat semua</a>
        </div>
        <div class="kondisi-grid">
            @foreach ($ruangan as $r)
                <div class="kondisi-item">
                    <div>
                        <strong>{{ $r['nama'] }}</strong>
                        <small>Lantai {{ $r['lantai'] }} · {{ $r['suhu'] }}°C</small>
                    </div>
                    <span class="badge badge-{{ strtolower($r['status']) }}">{{ $r['status'] }}</span>
                </div>
            @endforeach
        </div>
    </section>
@endsection