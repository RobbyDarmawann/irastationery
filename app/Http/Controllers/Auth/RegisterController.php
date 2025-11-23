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
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_lengkap'  => ['required', 'string', 'max:255'],
            'username'      => ['required', 'string', 'max:255', 'unique:users'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'jenis_kelamin' => ['required', 'string', Rule::in(['Laki-laki', 'Perempuan'])],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'nama_lengkap'  => $validatedData['nama_lengkap'],
            'username'      => $validatedData['username'],
            'email'         => $validatedData['email'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'password'      => Hash::make($validatedData['password']),
        ]);

        Auth::login($user);
        return redirect('/');
    }
}