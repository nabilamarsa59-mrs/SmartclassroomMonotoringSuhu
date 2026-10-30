<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GuruAuthController;
use App\Http\Middleware\HanyaGuru;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('Auth.Login');
})->name('login');

Route::post('/login', [GuruAuthController::class, 'login'])
    ->middleware('throttle:5,1')   // maksimal 5 percobaan per menit
    ->name('login.proses');

Route::post('/logout', [GuruAuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Wali Kelas (hanya guru yang sudah login)
|--------------------------------------------------------------------------
*/
Route::prefix('walikelas')->name('walikelas.')->middleware(HanyaGuru::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('WaliKelas.Dashboard');
    })->name('dashboard');

    Route::get('/ruangan', function () {
        return view('WaliKelas.Ruangan');
    })->name('ruangan');

    Route::get('/riwayat', function () {
        return view('WaliKelas.Riwayat');
    })->name('riwayat');

    Route::get('/pengaturan', function () {
        return view('WaliKelas.Pengaturan');
    })->name('pengaturan');
});

// Halaman depan (pilih peran) + proses login Petugas TU: terbuka untuk umum
Route::get('/portal', [PageController::class, 'portal'])->name('portal');
Route::post('/tu/login', [PageController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('tu.login.proses');

// Halaman di bawah dijaga di PageController (hanya Petugas TU yang sudah login)
Route::prefix('tu')->name('tu.')->group(function () {
    Route::get('/beranda', [PageController::class, 'beranda'])->name('beranda');
    Route::get('/ruangan', [PageController::class, 'ruangan'])->name('ruangan');
    Route::get('/guru', [PageController::class, 'guru'])->name('guru');
    Route::post('/guru', [PageController::class, 'guruStore'])->name('guru.store');
    Route::put('/guru/{id}', [PageController::class, 'guruUpdate'])->name('guru.update');
    Route::delete('/guru/{id}', [PageController::class, 'guruDestroy'])->name('guru.destroy');
    Route::get('/riwayat', [PageController::class, 'riwayat'])->name('riwayat');
    Route::get('/profil', [PageController::class, 'profil'])->name('profil');
    Route::put('/profil', [PageController::class, 'profilUpdate'])->name('profil.update');
    Route::post('/profil/foto', [PageController::class, 'profilFoto'])->name('profil.foto');
    Route::post('/keluar', [PageController::class, 'logout'])->name('keluar');
});