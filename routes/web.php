<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kategori', function () {
    return view('kategori');
})->name('kategori.index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login'); // Kita beri nama 'login'

// Rute untuk menampilkan halaman register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');