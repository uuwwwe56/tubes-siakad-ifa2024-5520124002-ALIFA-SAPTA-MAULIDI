<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        // HAPUS 'admin' dari load()
        $user->load(['mahasiswa', 'dosen']);

        $namaLengkap = '';
        if ($user->role === 'admin') {
            // Gunakan username sebagai nama tampilan Admin
            $namaLengkap = $user->username ?? 'Admin';
        } elseif ($user->role === 'dosen') {
            $namaLengkap = $user->dosen ? $user->dosen->nama : '';
        } else {
            $namaLengkap = $user->mahasiswa ? $user->mahasiswa->nama : '';
        }

        if ($user->role === 'admin') {
            return view('admin.profile.index', compact('user', 'namaLengkap'));
        } elseif ($user->role === 'dosen') {
            return view('dosen.profile.index', compact('user', 'namaLengkap'));
        } else {
            return view('mahasiswa.profile.index', compact('user', 'namaLengkap'));
        }
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validasi Input
        $rules = [
            'name'   => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        if ($request->filled('password')) {
            $rules['old_password'] = 'required|string';
            $rules['password']     = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        // 2. Validasi & Update Password
        if ($request->filled('password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama yang Anda masukkan salah.']);
            }
            $user->password = Hash::make($request->password);
        }

        // 3. Update Avatar
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        // 4. Update Nama Lengkap ke Tabel Relasi Sesuai Role (Bebas dari kolom 'name' di tabel users)
        if ($user->role === 'dosen' && $user->dosen) {
            $user->dosen->update([
                'nama' => $request->name
            ]);
        } elseif ($user->role === 'mahasiswa' && $user->mahasiswa) {
            $user->mahasiswa->update([
                'nama' => $request->name
            ]);
        } elseif ($user->role === 'admin') {
            if ($user->admin) { // <-- INI YANG MERUSAK SYSTEM KARENA RELASI 'admin' TIDAK ADA
                $user->admin->update([
                    'nama' => $request->name
                ]);
            } else {
                $user->update([
                    'username' => $request->name
                ]);
            }
        }

        return back()->with('success', 'Profil dan keamanan akun berhasil diperbarui.');
    }
}
