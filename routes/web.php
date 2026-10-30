<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('Auth.Login');
});
Route::prefix('walikelas')->name('walikelas.')->group(function () {
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