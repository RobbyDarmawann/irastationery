@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl py-12 px-4 sm:px-6 lg:px-8">
    
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Profil Saya</h1>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 
      X-DATA: Mengontrol mode Edit/View
      isEditing: false (Default tampilan info)
    -->
    <div class="bg-white shadow rounded-lg overflow-hidden" x-data="{ isEditing: {{ $errors->any() ? 'true' : 'false' }} }">
        
        <!-- HEADER KARTU -->
        <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Informasi Akun</h3>
            
            <!-- Tombol Ubah Profil (Hanya muncul saat TIDAK editing) -->
            <button @click="isEditing = true" 
                    x-show="!isEditing" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Ubah Profil
            </button>

            <!-- Tombol Batal (Hanya muncul saat EDITING) -->
            <button @click="isEditing = false" 
                    x-show="isEditing" 
                    x-cloak
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Batal
            </button>
        </div>

        <!-- 
          MODE VIEW (TAMPILAN INFORMASI) 
          Ditampilkan saat !isEditing
        -->
        <div class="p-6" x-show="!isEditing">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                    <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $user->nama_lengkap }}</dd>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Username</dt>
                    <dd class="mt-1 text-sm text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded inline-block">
                        {{ $user->username }}
                        <span class="ml-2 text-xs text-gray-500 font-normal">(Tidak dapat diubah)</span>
                    </dd>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Alamat Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $user->email }}
                        <span class="ml-2 text-xs text-gray-500">(Tidak dapat diubah)</span>
                    </dd>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $user->jenis_kelamin }}</dd>
                </div>

                <!-- Password tidak ditampilkan demi keamanan -->
                <div class="sm:col-span-2 border-t border-gray-100 pt-4 mt-2">
                    <dt class="text-sm font-medium text-gray-500">Password</dt>
                    <dd class="mt-1 text-sm text-gray-900">********</dd>
                </div>

            </dl>
        </div>

        <!-- 
          MODE EDIT (FORMULIR) 
          Ditampilkan saat isEditing bernilai true
        -->
        <div x-show="isEditing" x-cloak>
            <form action="{{ route('user.profil.update') }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Nama Lengkap (Bisa Diedit) -->
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border p-2">
                    </div>

                    <!-- Username (DISABLED / Read-only) -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-500">Username</label>
                        <input type="text" value="{{ $user->username }}" disabled class="mt-1 block w-full border-gray-200 bg-gray-100 text-gray-500 rounded-md shadow-sm sm:text-sm border p-2 cursor-not-allowed">
                        <p class="mt-1 text-xs text-gray-400">Username tidak dapat diubah.</p>
                        <!-- Input hidden agar validasi backend tidak error jika field required -->
                        <input type="hidden" name="username" value="{{ $user->username }}">
                    </div>

                    <!-- Email (DISABLED / Read-only) -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-500">Email</label>
                        <input type="email" value="{{ $user->email }}" disabled class="mt-1 block w-full border-gray-200 bg-gray-100 text-gray-500 rounded-md shadow-sm sm:text-sm border p-2 cursor-not-allowed">
                        <p class="mt-1 text-xs text-gray-400">Email tidak dapat diubah.</p>
                        <input type="hidden" name="email" value="{{ $user->email }}">
                    </div>

                    <!-- Jenis Kelamin (Bisa Diedit) -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md border">
                            <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Ubah Password</h3>
                    <p class="mt-1 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah password.</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                        <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border p-2">
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border p-2">
                        </div>

                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border p-2">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <!-- Tombol Batal di bawah juga -->
                    <button type="button" @click="isEditing = false" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Batal
                    </button>
                    <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection