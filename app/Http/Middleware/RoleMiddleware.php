<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request with strict role isolation
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        // Jika belum login, tolak dan arahkan ke halaman login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Akses dibatasi. Silakan masuk dengan akun/NIP Anda terlebih dahulu.');
        }

        // Cek status keaktifan akun
        if (!$user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            return redirect()->route('login')->with('error', 'Akun Anda telah dinonaktifkan.');
        }

        // Jika role tidak sesuai, tolak akses dan kembalikan ke dashboard masing-masing
        if ($user->role !== $role) {
            $targetDashboard = match ($user->role) {
                'admin' => route('admin.dashboard'),
                'kepsek' => route('kepsek.dashboard'),
                'pj' => route('pj.dashboard'),
                default => route('login'),
            };

            return redirect($targetDashboard)->with('warning', "Akses Ditolak! Anda masuk sebagai " . strtoupper($user->role) . " dan tidak berhak mengakses area " . strtoupper($role) . ".");
        }

        // Catat aktivitas aktif di web (Status Online)
        if (!$user->last_seen_at || $user->last_seen_at->lt(now()->subMinute())) {
            $user->updateQuietly(['last_seen_at' => now()]);
        }

        return $next($request);
    }
}
