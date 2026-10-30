<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HanyaGuru
{
    public const ROLE_GURU = ['guru', 'wali_kelas', 'walikelas', 'wali kelas'];

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !in_array(strtolower(trim((string) $user->role)), self::ROLE_GURU, true)) {
            return redirect('/login')->withErrors([
                'nip' => 'Silakan masuk terlebih dahulu.',
            ]);
        }

        return $next($request);
    }
}