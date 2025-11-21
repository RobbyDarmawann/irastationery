@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Daftar Kategori</h1>
        
        <div class="grid grid-cols-3 gap-4 md:grid-cols-6 lg:grid-cols-8 md:gap-6">
            
            @php
                $kategori = [
                    'Aksesoris', 'Alat Musik', 'Alat Sholat', 'Alat Tulis Sekolah',
                    'Bahan Kue', 'Buku & Majalah', 'Dekorasi Interior', 'Elektronik',
                    'Fashion', 'Kerajinan', 'Kecantikan', 'Kebersihan',
                    'Makanan Ringan', 'Mainan', 'Minuman', 'Olahraga',
                    'Perabotan Rumah', 'Peralatan Makanan', 'Perlengkapan Bayi',
                    'Perlengkapan Kantor', 'Perlengkapan Sekolah'
                ];
            @endphp

            @foreach ($kategori as $item)
                @php
                    $slug = Str::slug($item);
                    $gambar = "resources/images/kategori/{$slug}.png";
                @endphp
                
                <a href="#" class="group flex flex-col items-center justify-start p-3 sm:p-4 bg-gray-100 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300">
                    
                    <img src="{{ Vite::asset($gambar) }}" alt="{{ $item }}" class="h-16 w-16 sm:h-20 sm:w-20 object-contain">
                    
                    <span class="mt-4 text-xs sm:text-sm font-medium text-gray-700 group-hover:text-gray-900 text-center">{{ $item }}</span>
                
                </a>
            @endforeach

        </div>
    </div>
@endsection