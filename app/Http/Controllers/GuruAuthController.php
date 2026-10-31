<?php

namespace App\Http\Controllers;

use App\Http\Middleware\HanyaGuru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuruAuthController extends Controller
{
    // Proses login guru: cocokkan NIP + kata sandi, lalu masuk ke dashboard wali kelas
    public function login(Request $request)
    {
        $data = $request->validate([
            'nip'      => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'nip.required'      => 'NIP wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Cari akun berdasarkan NIP, lalu pastikan role-nya guru
        $guru = User::where('nip', trim($data['nip']))->first();

        $adalahGuru = $guru
            && in_array(strtolower(trim((string) $guru->role)), HanyaGuru::ROLE_GURU, true);

        // Kalau tabel punya kolom "status", hanya yang Aktif boleh masuk
        $aktif = $guru
            && (!isset($guru->status) || strtolower(trim((string) $guru->status)) === 'aktif');

        if (!$adalahGuru || !$aktif || !Hash::check($data['password'], $guru->password)) {
            return back()
                ->withInput($request->only('nip'))
                ->withErrors(['nip' => 'NIP atau kata sandi salah, atau akun tidak aktif.']);
        }

        Auth::login($guru, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->route('walikelas.dashboard');
    }

    // Keluar dari sistem, kembali ke halaman depan (portal)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('portal')
            ->with('info', 'Anda telah keluar dari sistem.');
    }
}