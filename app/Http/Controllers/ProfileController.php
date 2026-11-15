<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ActivityLog;

class ProfileController extends Controller
{
    /**
     * Upload & Ganti Foto Profil untuk Semua Role (Admin, Kepsek, PJ)
     * Validasi: Gambar (JPEG, PNG, JPG, WEBP), Maksimal 3 MB (3072 KB)
     */
    public function updateFoto(Request $request)
    {
        $user = Auth::user();

        // Hak akses: PJ tidak dapat mengubah foto sendiri, hanya admin yang berwenang
        if ($user->role === 'pj') {
            return back()->with('error', 'Pengaturan foto profil Penanggung Jawab hanya dapat diubah oleh Administrator Sarpras.');
        }

        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
        ], [
            'foto.required' => 'File foto profil wajib dipilih.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPEG, PNG, JPG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal adalah 3 MB (3072 KB).',
        ]);

        // Hapus foto lama jika ada dan bukan default
        if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        // Simpan foto baru
        $path = $request->file('foto')->store('profiles', 'public');
        $user->foto_profil = $path;
        $user->save();

        // Sinkronisasi data session
        if (session()->has('auth_user')) {
            $sess = session('auth_user');
            $sess['foto_url'] = $user->foto_url;
            session(['auth_user' => $sess]);
        }

        ActivityLog::log('UPDATE_PROFILE_PHOTO', "Mengubah foto profil akun {$user->name}.", $user);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui!',
                'foto_url' => asset('storage/' . $path),
            ]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    /**
     * Update Biodata Profil (Nama, Kontak, Password)
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:150',
            'kontak' => 'nullable|string|max:20',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        $request->validate($rules);

        $user->name = $request->name;
        if ($request->filled('kontak')) {
            $user->kontak = $request->kontak;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        ActivityLog::log('UPDATE_PROFILE', "Memperbarui biodata akun {$user->name}.", $user);

        return back()->with('success', 'Biodata profil berhasil disimpan!');
    }
}
