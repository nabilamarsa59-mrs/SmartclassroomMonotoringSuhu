<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\DummyData;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PageController extends Controller implements HasMiddleware
{
    /**
     * Penjaga: semua halaman Petugas TU hanya bisa dibuka setelah login sebagai
     * Petugas TU. Pengecualian: halaman depan (portal) dan proses login.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                $user = $request->user();

                if (! $user || $user->role !== 'tu') {
                    return redirect()->guest(route('portal', ['peran' => 'tu']));
                }

                return $next($request);
            }, except: ['portal', 'login']),
        ];
    }

    private const EMAIL_OTOMATIS = '@guru.smartclassroom.local';

    private ?User $akunTU = null;

    public function __construct()
    {
        // Variabel $akun tersedia di semua view PetugasTU setelah login
        view()->composer('PetugasTU.*', function ($view) {
            if (Auth::check()) {
                $view->with('akun', $this->akun());
            }
        });
    }

    /** Akun Petugas TU yang sedang login. */
    private function akunModel(): User
    {
        return $this->akunTU ??= Auth::user();
    }

    private function akun(): array
    {
        $u = $this->akunModel();

        return [
            'nama'       => $u->name,
            'nama_depan' => explode(' ', trim($u->name))[0],
            'inisial'    => strtoupper(mb_substr($u->name, 0, 1)),
            'email'      => $u->email,
            'telepon'    => $u->telepon,
            'peran'      => 'TU / Administrator',
            'sekolah'    => DummyData::user()['sekolah'],
            'foto'       => $u->foto ? asset($u->foto).'?v='.optional($u->updated_at)->timestamp : null,
        ];
    }

    public function beranda()
    {
        // Status ruangan disamakan dengan halaman Kelola Ruangan: Aktif / Nonaktif
        $ruangan = collect(DummyData::ruangan())
            ->map(function ($r) {
                $r['status'] = $r['status'] === 'Perawatan' ? 'Nonaktif' : 'Aktif';
                return $r;
            })
            ->all();

        $akun = $this->akun();

        return view('PetugasTU.beranda', [
            'user'       => ['nama' => $akun['nama_depan'], 'peran' => $akun['peran']],
            'totalKelas' => count($ruangan),
            'totalGuru'  => User::where('role', 'guru')->count(),
            'kelasAktif' => collect($ruangan)->where('status', 'Aktif')->count(),
            'ruangan'    => $ruangan,
        ]);
    }

    public function ruangan()
    {
        return view('PetugasTU.ruangan', ['ruangan' => DummyData::ruangan()]);
    }

    public function guru()
    {
        $guru = User::where('role', 'guru')
            ->latest('id')
            ->get()
            ->map(fn ($u) => [
                'id'      => $u->id,
                'nama'    => $u->name,
                'nip'     => $u->nip,
                'email'   => str_ends_with($u->email, self::EMAIL_OTOMATIS) ? null : $u->email,
                'telepon' => $u->telepon,
                'status'  => $u->status ?? 'Aktif',
            ])
            ->all();

        return view('PetugasTU.guru', ['guru' => $guru]);
    }

    public function guruStore(Request $request)
    {
        $data = $request->validate([
            'nip'      => ['required', 'digits_between:5,25', 'unique:users,nip'],
            'nama'     => ['required', 'string', 'max:100'],
            'email'    => ['nullable', 'email', 'max:150', 'unique:users,email'],
            'telepon'  => ['nullable', 'string', 'max:20'],
            'status'   => ['required', 'in:Aktif,Nonaktif'],
            'sandi'    => ['required', 'string', 'min:6'],
        ], [
            'nip.required'        => 'NIP wajib diisi.',
            'nip.digits_between'  => 'NIP harus berupa angka, 5 sampai 25 digit.',
            'nip.unique'          => 'NIP ini sudah terdaftar.',
            'nama.required'       => 'Nama wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'email.unique'        => 'Email ini sudah dipakai.',
            'sandi.required'      => 'Kata sandi wajib diisi.',
            'sandi.min'           => 'Kata sandi minimal 6 karakter.',
        ]);

        // forceCreate: tidak perlu mengubah $fillable di Model User
        User::forceCreate([
            'name'     => $data['nama'],
            'nip'      => $data['nip'],
            // email wajib unik di tabel users, jadi dibuatkan otomatis bila dikosongkan
            'email'    => $data['email'] ?? ($data['nip'].self::EMAIL_OTOMATIS),
            'telepon'  => $data['telepon'] ?? null,
            'role'     => 'guru',
            'status'   => $data['status'],
            'password' => Hash::make($data['sandi']),
        ]);

        return redirect()->route('tu.guru')->with('sukses', 'Guru ditambahkan. Akunnya bisa dipakai untuk login.');
    }

    public function guruUpdate(Request $request, $id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);

        $data = $request->validate([
            'nip'      => ['required', 'digits_between:5,25', Rule::unique('users', 'nip')->ignore($guru->id)],
            'nama'     => ['required', 'string', 'max:100'],
            'email'    => ['nullable', 'email', 'max:150', Rule::unique('users', 'email')->ignore($guru->id)],
            'telepon'  => ['nullable', 'string', 'max:20'],
            'status'   => ['required', 'in:Aktif,Nonaktif'],
            'sandi'    => ['nullable', 'string', 'min:6'],
        ], [
            'nip.required'        => 'NIP wajib diisi.',
            'nip.digits_between'  => 'NIP harus berupa angka, 5 sampai 25 digit.',
            'nip.unique'          => 'NIP ini sudah dipakai guru lain.',
            'nama.required'       => 'Nama wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'email.unique'        => 'Email ini sudah dipakai.',
            'sandi.min'           => 'Kata sandi minimal 6 karakter.',
        ]);

        $guru->forceFill([
            'name'    => $data['nama'],
            'nip'     => $data['nip'],
            'email'   => $data['email'] ?? ($data['nip'].self::EMAIL_OTOMATIS),
            'telepon' => $data['telepon'] ?? null,
            'status'  => $data['status'],
        ]);

        // Kata sandi hanya diganti kalau diisi
        if (! empty($data['sandi'])) {
            $guru->forceFill(['password' => Hash::make($data['sandi'])]);
        }

        $guru->save();

        return redirect()->route('tu.guru')->with('sukses', 'Data guru diperbarui.');
    }

    public function guruDestroy($id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);
        $guru->delete();

        return redirect()->route('tu.guru')->with('sukses', 'Guru dihapus. Akunnya tidak bisa dipakai login lagi.');
    }

    public function riwayat()
    {
        return view('PetugasTU.riwayat', ['riwayat' => DummyData::riwayat()]);
    }

    // ===== Portal (halaman depan) & login Petugas TU =====

    public function portal()
    {
        // Yang sudah login langsung diarahkan ke halamannya masing-masing
        $user = Auth::user();

        if ($user && $user->role === 'tu') {
            return redirect()->route('tu.beranda');
        }

        if ($user && $user->role === 'guru') {
            return redirect()->route('walikelas.dashboard');
        }

        return view('PetugasTU.portal');
    }

    public function login(Request $request)
    {
        $kredensial = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Hanya akun ber-role "tu" yang berstatus Aktif yang boleh masuk
        if (Auth::attempt($kredensial + ['role' => 'tu', 'status' => 'Aktif'])) {
            $request->session()->regenerate();

            return redirect()->intended(route('tu.beranda'));
        }

        return back()
            ->withErrors(['email' => 'Email atau kata sandi salah, atau akun tidak aktif.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('portal', ['peran' => 'tu'])
            ->with('info', 'Anda telah keluar dari sistem.');
    }

    public function profil()
    {
        return view('PetugasTU.profil');
    }

    public function profilUpdate(Request $request)
    {
        $u = $this->akunModel();

        $data = $request->validate([
            'nama'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($u->id)],
            'telepon' => ['nullable', 'string', 'max:20'],
        ], [
            'nama.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email ini sudah dipakai akun lain.',
        ]);

        $u->forceFill([
            'name'    => $data['nama'],
            'email'   => $data['email'],
            'telepon' => $data['telepon'] ?? null,
        ])->save();

        return redirect()->route('tu.profil')->with('sukses', 'Profil disimpan.');
    }

    public function profilFoto(Request $request)
    {
        $request->validate([
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'foto.required' => 'Pilih foto terlebih dulu.',
            'foto.image'    => 'File harus berupa gambar.',
            'foto.mimes'    => 'Format foto harus JPG, PNG, atau WEBP.',
            'foto.max'      => 'Ukuran foto maksimal 2 MB.',
            'foto.uploaded' => 'Foto gagal diunggah. Ukuran maksimal 2 MB.',
        ]);

        $u = $this->akunModel();
        $file = $request->file('foto');
        $nama = 'tu-'.$u->id.'-'.time().'.'.$file->extension();

        $file->move(public_path('uploads/profil'), $nama);

        if ($u->foto && file_exists(public_path($u->foto))) {
            @unlink(public_path($u->foto));
        }

        $u->forceFill(['foto' => 'uploads/profil/'.$nama])->save();

        return redirect()->route('tu.profil')->with('sukses', 'Foto profil diperbarui.');
    }
}