<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Menangani percobaan login.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi input dari form
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Cek apakah input 'login' adalah email atau username
        // Ini adalah logika untuk "Login dengan Username atau Email"
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Buat kredensial untuk dicoba login
        $credentials = [
            $loginField => $request->login,
            'password' => $request->password
        ];

        // 4. Coba lakukan autentikasi
        if (Auth::attempt($credentials)) {
            
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // 5. PENGECEKAN ROLE (KUNCI UTAMA)
            $user = Auth::user();

            if ($user->role == 'admin') {
                // Jika admin, arahkan ke dashboard admin
                return redirect()->intended(route('admin.dashboard'));
            }
            
            // Jika bukan admin (misal 'pengguna')
            // Kita arahkan ke halaman utama untuk saat ini
            return redirect()->intended('/');
        }

        // 6. Jika login gagal (kredensial salah)
        return back()->withErrors([
            'login' => 'Username/Email atau Password Anda salah.',
        ])->onlyInput('login');
    }

    /**
     * Menangani proses logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman utama
        return redirect('/');
    }
}