@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    @include('components.admin-header')

    <main class="container mx-auto px-4 py-8">
    <div class="relative z-10">
        <!-- Background gradient effect -->
        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 via-purple-500 to-pink-500 rounded-3xl opacity-90 blur-sm"></div>
        
        <!-- Main content container -->
        <div class="relative bg-gradient-to-r from-purple-600 via-purple-500 to-pink-500 rounded-3xl p-8 shadow-xl min-h-[170px]"> 
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <!-- Left content -->
                <div class="space-y-4">
                    <h1 class="text-3xl lg:text-4xl font-bold text-white">
                        Manajemen Admin
                    </h1>
                    <p class="text-white/90 text-lg">Kelola dan pantau semua kriteria akreditasi institusi</p>
                </div>
    
                <!-- Enhanced Search -->
                <div class="w-full lg:w-96">
                    <form method="GET" class="relative group">
                        <div class="relative bg-white rounded-2xl shadow-lg">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Admin Panel Section -->
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-9xl w-full">
            <!-- Card Template Start -->
            @php
                $cards = [
                    [
                        'title' => 'Manajemen Pengguna',
                        'desc' => 'Menambahkan, mengubah dan menghapus pengguna',
                        'img' => 'images/people.png',
                        'route' => route('superadmin.manage.users'),
                        'btn' => 'Detail Pengguna',
                    ],
                    [
                        'title' => 'Manajemen Kriteria dan Subkriteria',
                        'desc' => 'Menambahkan, mengubah dan menghapus Kriteria dan Subkriteria',
                        'img' => 'images/criteria-icon.png',
                        'route' => route('superadmin.manage.kriteria'),
                        'btn' => 'Manajemen Kriteria dan Subkriteria',
                    ],
                    [
                        'title' => 'Riwayat Perubahan Kriteria',
                        'desc' => 'Menampilkan riwayat pengisian kriteria yang dilakukan oleh anggota',
                        'img' => 'images/time.png',
                        'route' => route('superadmin.riwayat.isian'),
                        'btn' => 'Riwayat Perubahan Kriteria',
        ]

                ];
            @endphp

            @foreach ($cards as $card)
                <div class="relative group bg-white rounded-3xl border border-gray-200 p-8 text-center shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative z-10 flex flex-col items-center">
                        <img src="{{ asset($card['img']) }}" alt="Icon" class="w-24 h-24 mb-6 drop-shadow-md transition-transform duration-300 group-hover:scale-105" />
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $card['title'] }}</h3>
                        <p class="text-gray-500 mb-5 text-sm">{{ $card['desc'] }}</p>
                        <a href="{{ $card['route'] }}" class="inline-block bg-orange-500 text-white px-5 py-2.5 rounded-full font-medium hover:bg-orange-600 transition duration-300">
                            {{ $card['btn'] }}
                        </a>
                    </div>
                </div>
                @endforeach
                <!-- Card Template End -->
            </div>
        </div>
    </main>
</div>

<!-- Initialize Lucide Icons -->
<script>
    lucide.createIcons();
</script>
@endsection

<style>
    /* Custom animations and effects */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Glassmorphism effect */
    .glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
    
    /* Custom gradient text */
    .gradient-text {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>