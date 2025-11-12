<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Katalog Instansi</title>
        
        <style>
            [x-cloak] { display: none !important; }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="antialiased bg-gray-100 flex flex-col min-h-screen">
        
        <nav class="bg-white shadow-md sticky top-0 z-50 flex-shrink-0" x-data="{ openSearch: false, openMobileMenu: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ url('/') }}">
                            <img class="h-10 w-auto" src="{{ Vite::asset('resources/images/logo-ira.png') }}" alt="Logo Instansi">
                        </a>
                    </div>
                    <div class="hidden md:flex items-center">
                        <div class="flex items-center space-x-2 sm:space-x-4">
                            <a href="{{ route('kategori.index') }}" class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-md text-base font-medium">Kategori</a>
                            <button @click="openSearch = !openSearch" class="p-2 rounded-full text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                                <span class="sr-only">Cari</span><svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                        </div>
                        <div x-show="openSearch" @click.away="openSearch = false" x-transition:enter="transition-all ease-out duration-300" x-transition:enter-start="opacity-0 w-0" x-transition:enter-end="opacity-100 w-48 sm:w-64" x-transition:leave="transition-all ease-in duration-200" x-transition:leave-start="opacity-100 w-48 sm:w-64" x-transition:leave-end="opacity-0 w-0" class="overflow-hidden ml-2" x-cloak>
                            <form action="#" method="GET" class="relative">
                                <input type="text" placeholder="Cari produk..." class="w-full p-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500" autofocus>
                            </form>
                        </div>
                        <div class="flex items-center space-x-2 sm:space-x-4 ml-4"> 
                            <a href="" class="flex items-center text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-md text-base font-medium">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg><span>Login</span>
                            </a>
                            <a href="" class="flex items-center text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-md text-base font-medium">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg><span>Register</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center md:hidden">
                        <button @click="openMobileMenu = !openMobileMenu" class="p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                            <span class="sr-only">Buka menu</span><svg x-show="!openMobileMenu" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                            <svg x-show="openMobileMenu" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div x-show="openMobileMenu" @click.away="openMobileMenu = false" class="md:hidden" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" x-cloak>
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <div class="px-2 pb-2"><form action="#" method="GET"><input type="text" placeholder="Cari produk..." class="w-full p-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500"></form></div>
                    <a href="{{ route('kategori.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">Kategori</a>
                    <a href="" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">Login</a>
                    <a href="" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">Register</a>
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            @yield('content')
        </main>

        <x-footer />

    </body>
</html>