@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-lg font-bold">Sistem Akreditasi</h1>
                                <p class="text-xs text-gray-600">Dashboard Validator</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <nav class="hidden md:flex items-center gap-4">
                            <a href="{{ route('validator.dashboard') }}" class="px-3 py-2 text-sm font-medium {{ request()->routeIs('validator.dashboard') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Beranda
                            </a>
                            <a href="{{ route('validator.kriteria') }}" class="px-3 py-2 text-sm font-medium {{ request()->routeIs('validator.kriteria') ? 'text-blue-600 bg-blue-50 rounded-md' : 'text-gray-600 hover:text-blue-600' }}">
                                Validasi Kriteria
                            </a>
                        </nav>

                        <div class="flex items-center gap-2">
                            <div class="relative">
                                <img src="{{ asset('images/avatar.png') }}" alt="User" class="w-8 h-8 rounded-full">
                            </div>
                            <div class="hidden sm:block">
                                <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Validator</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="ml-2 text-gray-500 hover:text-red-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="container mx-auto px-4 py-6">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <!-- Header and Search -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Validasi Kriteria</h1>

                    <div class="relative w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            type="search"
                            placeholder="Cari kriteria..."
                            value="{{ request('search') }}"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        >
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-xs">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Menunggu Validasi</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $pendingValidation }}</p>
                            </div>
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-xs">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Perlu Revisi</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $needsRevision }}</p>
                            </div>
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-xs">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Tervalidasi</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $validated }}</p>
                            </div>
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs and Filters -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div class="flex overflow-x-auto pb-2">
                        <a href="{{ route('validator.dashboard', ['tab' => 'validation']) }}" class="px-4 py-2 text-sm font-medium whitespace-nowrap {{ $activeTab === 'validation' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                            Menunggu Validasi
                        </a>
                        <a href="{{ route('validator.dashboard', ['tab' => 'revision']) }}" class="px-4 py-2 text-sm font-medium whitespace-nowrap {{ $activeTab === 'revision' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                            Perlu Revisi
                        </a>
                        <a href="{{ route('validator.dashboard', ['tab' => 'validated']) }}" class="px-4 py-2 text-sm font-medium whitespace-nowrap {{ $activeTab === 'validated' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                            Tervalidasi
                        </a>
                        <a href="{{ route('validator.dashboard', ['tab' => 'all']) }}" class="px-4 py-2 text-sm font-medium whitespace-nowrap {{ $activeTab === 'all' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                            Semua
                        </a>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500">Urutkan:</span>
                        <select class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="newest" {{ $sortBy === 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ $sortBy === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="priority-high" {{ $sortBy === 'priority-high' ? 'selected' : '' }}>Prioritas Tinggi</option>
                            <option value="priority-low" {{ $sortBy === 'priority-low' ? 'selected' : '' }}>Prioritas Rendah</option>
                        </select>
                    </div>
                </div>

                <!-- kriteria List -->
                <div class="space-y-4">
                    @if(count($filteredKriteria) > 0)
                        @foreach($filteredKriteria as $kriteria)
                            @include('components.validator-kriteria-card', ['kriteria' => $kriteria])
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada kriteria ditemukan</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                @if($activeTab === 'validation')
                                    Tidak ada kriteria yang menunggu validasi saat ini.
                                @elseif($activeTab === 'revision')
                                    Tidak ada kriteria yang perlu revisi saat ini.
                                @elseif($activeTab === 'validated')
                                    Belum ada kriteria yang tervalidasi.
                                @else
                                    Coba ubah filter atau kata kunci pencarian Anda.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Pagination and Summary -->
                @if(count($filteredKriteria) > 0)
                    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-700 mb-2 sm:mb-0">
                            Menampilkan <span class="font-medium">{{ count($filteredKriteria) }}</span> dari <span class="font-medium">{{ count($allKriteria) }}</span> kriteria
                        </div>
                        <div class="text-sm text-blue-600 font-medium">
                            @if($activeTab === 'validation')
                                {{ $pendingValidation }} menunggu validasi Anda
                            @elseif($activeTab === 'revision')
                                {{ $needsRevision }} perlu tindak lanjut
                            @elseif($activeTab === 'validated')
                                {{ $validated }} telah selesai divalidasi
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
@endsection
