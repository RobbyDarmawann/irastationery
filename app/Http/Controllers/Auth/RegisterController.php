<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Menyimpan pengguna baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi input
        $validatedData = $request->validate([
            'nama_lengkap'  => ['required', 'string', 'max:255'],
            'username'      => ['required', 'string', 'max:255', 'unique:users'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'jenis_kelamin' => ['required', 'string', Rule::in(['Laki-laki', 'Perempuan'])],
            
            // INI ADALAH VALIDASI YANG ANDA MINTA:
            // 'confirmed' akan otomatis mencocokkan dengan field 'password_confirmation'
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Buat pengguna baru
        $user = User::create([
            'nama_lengkap'  => $validatedData['nama_lengkap'],
            'username'      => $validatedData['username'],
            'email'         => $validatedData['email'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'password'      => Hash::make($validatedData['password']),
            // 'role' akan otomatis 'pengguna' (sesuai setting default di migrasi)
        ]);

        // 3. Login pengguna yang baru dibuat
        Auth::login($user);

        // 4. Redirect ke halaman utama (katalog)
        return redirect('/');
    }
}