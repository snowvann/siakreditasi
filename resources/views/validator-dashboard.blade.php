@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">Sistem Akreditasi</h1>
                            <p class="text-sm text-gray-600">Dashboard Validator</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <nav class="hidden md:flex items-center gap-6">
                        <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none ring-offset-background hover:bg-accent hover:text-accent-foreground h-10 py-2 px-4">
                            Beranda
                        </button>
                        <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none ring-offset-background bg-primary text-primary-foreground hover:bg-primary/90 h-10 py-2 px-4">
                            Validasi Kriteria
                        </button>
                    </nav>

                    <div class="flex items-center gap-3">
                        <div class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
                            <img src="/placeholder.svg" alt="Avatar" class="aspect-square h-full w-full" />
                            <span class="flex h-full w-full items-center justify-center rounded-full bg-muted">GX</span>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-sm font-medium">Gustavo Xavier</p>
                            <p class="text-xs text-gray-500">Validator Senior</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">
            <!-- Header dan Search -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h1 class="text-3xl font-bold flex-shrink-0">Validasi Kriteria</h1>

                <div class="flex-1 w-full max-w-md">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input
                            type="search"
                            placeholder="Cari kriteria yang perlu divalidasi..."
                            value="{{ request('search') }}"
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 pl-10"
                        />
                    </div>
                </div>
            </div>

            <!-- Statistik Validasi -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Menunggu Validasi</h3>
                                <p class="text-2xl font-bold mt-2">{{ $pendingValidation }}</p>
                            </div>
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Perlu Revisi</h3>
                                <p class="text-2xl font-bold mt-2">{{ $needsRevision }}</p>
                            </div>
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Tervalidasi</h3>
                                <p class="text-2xl font-bold mt-2">{{ $validated }}</p>
                            </div>
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs dan Controls -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="inline-flex items-center justify-center rounded-md bg-muted p-1">
                    <div class="flex space-x-1">
                        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 {{ $activeTab === 'validation' ? 'bg-background text-foreground shadow-sm' : 'text-muted-foreground' }}">
                            Menunggu Validasi
                        </button>
                        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 {{ $activeTab === 'revision' ? 'bg-background text-foreground shadow-sm' : 'text-muted-foreground' }}">
                            Perlu Revisi
                        </button>
                        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 {{ $activeTab === 'validated' ? 'bg-background text-foreground shadow-sm' : 'text-muted-foreground' }}">
                            Tervalidasi
                        </button>
                        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 {{ $activeTab === 'all' ? 'bg-background text-foreground shadow-sm' : 'text-muted-foreground' }}">
                            Semua
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-500">Urutkan:</span>
                    <select class="flex h-10 w-40 rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                        <option value="newest" {{ $sortBy === 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ $sortBy === 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="priority-high" {{ $sortBy === 'priority-high' ? 'selected' : '' }}>Prioritas Tinggi</option>
                        <option value="priority-low" {{ $sortBy === 'priority-low' ? 'selected' : '' }}>Prioritas Rendah</option>
                    </select>
                </div>
            </div>

            <!-- Kriteria List -->
            <div class="space-y-4">
                @if(count($filteredKriteria) > 0)
                    @foreach($filteredKriteria as $criteria)
                        @include('components.validator-kriteria-card', ['criteria' => $criteria])
                    @endforeach
                @else
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                        <div class="p-8 text-center">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada kriteria ditemukan</h3>
                            <p class="text-gray-500">
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
                    </div>
                @endif
            </div>

            <!-- Summary Footer -->
            @if(count($filteredKriteria) > 0)
                <div class="rounded-lg border bg-blue-50 border-blue-200">
                    <div class="p-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-blue-800">
                                Menampilkan {{ count($filteredKriteria) }} kriteria dari total {{ count($allKriteria) }} kriteria
                            </span>
                            <span class="text-blue-600 font-medium">
                                @if($activeTab === 'validation')
                                    {{ $pendingValidation }} menunggu validasi Anda
                                @elseif($activeTab === 'revision')
                                    {{ $needsRevision }} perlu tindak lanjut
                                @elseif($activeTab === 'validated')
                                    {{ $validated }} telah selesai divalidasi
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
</div>
@endsection