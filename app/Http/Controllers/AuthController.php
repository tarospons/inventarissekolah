<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login terpadu
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi berbasis database riil & Bcrypt hash (Otomatis deteksi role)
     */
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ], [
            'identifier.required' => 'Email atau NIP wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Rate limiting untuk proteksi brute force
        $throttleKey = 'login:' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withInput()->with('error', "Terlalu banyak percobaan masuk. Silakan tunggu {$seconds} detik lagi.");
        }

        $identifier = trim($request->input('identifier'));
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        // Normalisasi NIP (hilangkan spasi)
        $cleanNip = str_replace(' ', '', $identifier);

        // Cari user di database berdasarkan Email atau NIP
        $user = User::where('email', strtolower($identifier))
            ->orWhere('nip', $identifier)
            ->orWhereRaw("REPLACE(nip, ' ', '') = ?", [$cleanNip])
            ->first();

        // Validasi user ditemukan dan kata sandi cocok
        if (!$user || !Hash::check($password, $user->password)) {
            RateLimiter::hit($throttleKey, 60);
            return back()->withInput()->with('error', 'Kombinasi Email/NIP dan Kata Sandi tidak sesuai.');
        }

        // Cek status keaktifan akun
        if (!$user->is_active) {
            return back()->withInput()->with('error', 'Akun Anda dinonaktifkan oleh administrator sarpras.');
        }

        // Login ke session Laravel resmi
        RateLimiter::clear($throttleKey);
        Auth::login($user, $remember);
        $user->updateQuietly(['last_seen_at' => now()]);
        $request->session()->regenerate();

        // Sinkronisasi data session auth_user
        session(['auth_user' => [
            'id' => $user->id,
            'role' => $user->role,
            'name' => $user->name,
            'email' => $user->email,
            'nip' => $user->nip,
            'jabatan' => $user->jabatan,
            'jurusan' => $user->jurusan,
            'lab' => $user->ruangans->first()?->nama ?? $user->jabatan,
            'foto_url' => $user->foto_url,
        ]]);

        ActivityLog::log('LOGIN', "Pengguna {$user->name} ({$user->role}) berhasil masuk ke sistem.", $user);

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard')->with('success', "Selamat datang kembali, {$user->name}!"),
            'kepsek' => redirect()->route('kepsek.dashboard')->with('success', "Selamat datang, {$user->name}!"),
            'pj' => redirect()->route('pj.dashboard')->with('success', "Selamat datang, {$user->name}!"),
            default => redirect()->route('login'),
        };
    }

    /**
     * Keluar dari sesi login
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->updateQuietly(['last_seen_at' => null]);
            ActivityLog::log('LOGOUT', "Pengguna {$user->name} keluar dari sistem.", $user);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Anda telah berhasil keluar dari sistem inventaris.');
    }
}
