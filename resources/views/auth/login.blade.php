<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ke Akun Anda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100">

    <a href="{{ url('/') }}" 
       class="absolute top-5 left-5 z-10 p-2 bg-white rounded-full shadow-md text-gray-700 hover:bg-gray-100 transition-colors"
       aria-label="Kembali ke halaman utama">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>

    <div class="flex min-h-screen">
        <div class="hidden md:flex md:w-1/2 bg-gray-200 items-center justify-center">
            <img src="/images/login-icon.png" alt="Login Image" class="h-auto w-3/4 object-contain">
        </div>

        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-gray-900 text-center">
                    Login ke Akun Anda
                </h2>

                <form action="{{ route('login') }}" method="POST" class="mt-8">
                    @csrf
                    <div>
                        <label for="login" class="block text-sm font-medium text-gray-700">
                            Username atau Email
                        </label>
                        <div class="mt-1">
                            <input id="login" name="login" type="text" autocomplete="username" required
                                   class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <div class="mt-6" x-data="{ showPassword: false }">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" 
                                   :type="showPassword ? 'text' : 'password'" 
                                   autocomplete="current-password" required
                                   class="w-full p-3 pr-10 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                            <button type="button" @click="showPassword = !showPassword" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">

                                <svg x-show="!showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                <svg x-show="showPassword" x-cloak class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.866 0 3.64.59 5.124 1.58M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 2l20 20" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Login
                        </button>
                    </div>
                </form>
                <p class="mt-8 text-center text-sm text-gray-600">
                    Belum punya akun (Pengguna)?
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>