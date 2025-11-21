<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function show()
    {
        $user = Auth::user();
        return view('profil.show', compact('user'));
    }

    /**
     * Memperbarui profil pengguna.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            
            // Password opsional (hanya divalidasi jika diisi)
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        // Update data dasar
        $user->nama_lengkap = $validatedData['nama_lengkap'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->jenis_kelamin = $validatedData['jenis_kelamin'];

        // Update password jika ada
        if ($request->filled('new_password')) {
            $user->password = Hash::make($validatedData['new_password']);
        }

        $user->save();

        return redirect()->route('user.profil')->with('success', 'Profil berhasil diperbarui!');
    }
}