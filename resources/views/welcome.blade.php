@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Katalog Produk</h1>
        
        <div class="grid grid-cols-2 gap-4 md:gap-6 md:grid-cols-3 lg:grid-cols-4">
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <div class="h-56 w-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">Gambar Produk</span>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Nama Produk Placeholder</h3>
                    <p class="mt-2 text-sm text-gray-600">Deskripsi singkat produk akan muncul di sini.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                 <div class="h-56 w-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">Gambar Produk</span>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Nama Produk Placeholder</h3>
                    <p class="mt-2 text-sm text-gray-600">Deskripsi singkat produk akan muncul di sini.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                 <div class="h-56 w-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">Gambar Produk</span>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Nama Produk Placeholder</h3>
                    <p class="mt-2 text-sm text-gray-600">Deskripsi singkat produk akan muncul di sini.</g>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                 <div class="h-56 w-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">Gambar Produk</span>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Nama Produk Placeholder</h3>
                    <p class="mt-2 text-sm text-gray-600">Deskripsi singkat produk akan muncul di sini.</p>
                </div>
            </div>
        </div>
    </div>
@endsection