@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-8">
        <div class="space-y-8">
            <!-- Enhanced Header Section -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-3xl opacity-10 blur-xl"></div>
                <div class="relative bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-white/20">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <div class="space-y-2">
                            <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                                Validasi Kriteria Akreditasi
                            </h1>
                            <p class="text-gray-600 text-lg">Kelola dan pantau semua kriteria akreditasi D4 SIB</p>
                        </div>
                        
                        <!-- Enhanced Search -->
                        <div class="w-full lg:w-96">
                            <form method="GET" class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity"></div>
                                <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200/50">
                                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                                        </svg>
                                    </div>
                                    <input
                                        type="search"
                                        name="q"
                                        value="{{ request('q') }}"
                                        placeholder="Cari kriteria atau subkriteria..."
                                        class="w-full pl-12 pr-6 py-4 bg-transparent border-0 rounded-2xl focus:outline-none focus:ring-0 text-gray-700 placeholder-gray-400"
                                    />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Progress Card -->
            <div class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-3xl opacity-90"></div>
                <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full opacity-10 transform translate-x-32 -translate-y-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full opacity-10 transform -translate-x-16 translate-y-16"></div>
                
                <div class="relative p-8 text-white">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold">Progress Akreditasi</h2>
                            </div>
                            <p class="text-white/80 text-lg">Pantau dan kelola status keseluruhan kriteria akreditasi institusi Anda</p>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold">9</div>
                                <div class="text-white/80 text-sm">Total Kriteria</div>
                            </div>
                            <div class="w-px h-12 bg-white/30"></div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-300">✓</div>
                                <div class="text-white/80 text-sm">Aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Kriteria Grid -->
            @php
                $allKriteria = [
                    ['id' => 1, 'nama_kriteria' => 'Visi, Misi, Tujuan dan Strategi'],
                    ['id' => 2, 'nama_kriteria' => 'Tata Pamong, Tata Kelola dan Kerjasama'],
                    ['id' => 3, 'nama_kriteria' => 'Mahasiswa'],
                    ['id' => 4, 'nama_kriteria' => 'Sumber Daya Manusia'],
                    ['id' => 5, 'nama_kriteria' => 'Keuangan, Sarana dan Prasarana'],
                    ['id' => 6, 'nama_kriteria' => 'Pendidikan'],
                    ['id' => 7, 'nama_kriteria' => 'Penelitian'],
                    ['id' => 8, 'nama_kriteria' => 'Pengabdian kepada Masyarakat'],
                    ['id' => 9, 'nama_kriteria' => 'Luaran dan Capaian Tridharma'],
                ];

                $query = strtolower(request('q'));
                $filteredKriteria = array_filter($allKriteria, function($kriteria) use ($query) {
                    return $query === null || $query === ''
                        || str_contains(strtolower($kriteria['nama_kriteria']), $query);
                });

                $gradients = [
                    'from-indigo-500 to-purple-600',
                    'from-purple-500 to-pink-600',
                    'from-pink-500 to-rose-500',
                    'from-cyan-500 to-blue-600',
                    'from-green-500 to-emerald-600',
                    'from-yellow-500 to-orange-600',
                    'from-red-500 to-pink-600',
                    'from-blue-500 to-indigo-600',
                    'from-emerald-500 to-cyan-600',
                ];
            @endphp

            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-gray-800">Daftar Kriteria</h3>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <span>{{ count($filteredKriteria) }} dari {{ count($allKriteria) }}</span>
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    </div>
                </div>

                @if(count($filteredKriteria) > 0)
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($filteredKriteria as $index => $kriteria)
                            <div class="group relative">
                                <!-- Background gradient effect -->
                                <div class="absolute inset-0 bg-gradient-to-r {{ $gradients[$index % count($gradients)] }} rounded-3xl opacity-0 group-hover:opacity-10 transition-all duration-300 transform group-hover:scale-105"></div>
                                
                                <!-- Card content -->
                                <div class="relative bg-white rounded-3xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="w-12 h-12 bg-gradient-to-r {{ $gradients[$index % count($gradients)] }} rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                            {{ $kriteria['id'] }}
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                            <span class="text-xs text-gray-500 font-medium">AKTIF</span>
                                        </div>
                                    </div>
                                    
                                    <h3 class="font-bold text-gray-800 text-lg mb-3 leading-tight">
                                        {{ $kriteria['nama_kriteria'] }}
                                    </h3>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2 text-sm text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span>Kriteria {{ $kriteria['id'] }}</span>
                                        </div>
                                        
                                        <a href="{{ route('validator.kriteria.show', $kriteria['id']) }}" 
                                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r {{ $gradients[$index % count($gradients)] }} text-white text-sm font-medium rounded-xl hover:shadow-lg transition-all duration-200 hover:scale-105">
                                            <span>Detail</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Enhanced Empty State -->
                    <div class="text-center py-16">
                        <div class="relative inline-block">
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full opacity-20 blur-xl"></div>
                            <div class="relative w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada kriteria ditemukan</h3>
                        <p class="text-gray-500 mb-6">Coba ubah kata kunci pencarian atau hapus filter</p>
                        <a href="{{ route('kriteria.index') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-xl hover:shadow-lg transition-all duration-200 hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset Pencarian
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

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
@endsection