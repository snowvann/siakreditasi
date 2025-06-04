@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.validator-header')

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">
            <!-- Header dan Search -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h1 class="text-3xl font-bold flex-shrink-0">Validasi Kriteria</h1>
            
                <div class="flex-1 w-full">
                    <form action="" method="GET" class="w-full">
                        <div class="relative w-full">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                                </svg>
                            </span>
                            <input
                                type="search"
                                name="q"
                                placeholder="Cari kriteria untuk validasi..."
                                value="{{ request('search') }}"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                        </div>
                    </form>
                </div>
            </div>

            <!-- Progress Card -->
            @php
                $totalKriteria = count($allKriteria ?? []);
                $completedValidation = $validated ?? 0;
                $validationProgress = $totalKriteria > 0 ? round(($completedValidation / $totalKriteria) * 100) : 0;
            @endphp

            <div class="rounded-lg border text-card-foreground shadow-sm" style="background: linear-gradient(to top, rgba(0, 0, 0, 0.1), transparent), #E3F2FD;">
                <div class="p-6">
                    <h2 class="text-lg font-semibold">Progress Validasi</h2>
                    <p class="text-sm text-muted-foreground">Progress validasi kriteria akreditasi</p>
                </div>
                <div class="p-6 pt-0">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <div>Progress Validasi Keseluruhan</div>
                            <div class="font-medium">{{ $validationProgress }}%</div>
                        </div>
                        <div class="relative h-2 w-full overflow-hidden rounded-full bg-secondary">
                            <div class="h-full bg-blue-600 transition-all" style="width: {{ $validationProgress }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div x-data="{ activeTab: '{{ $activeTab ?? 'all' }}' }">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground">
                        @foreach([
                            'all' => 'Semua Kriteria',
                            'validation' => 'Menunggu Validasi',
                            'revision' => 'Perlu Revisi',
                            'validated' => 'Tervalidasi'
                        ] as $key => $label)
                            <a href="{{ route('validator.dashboard', ['tab' => $key]) }}" 
                                :class="activeTab === '{{ $key }}'
                                    ? 'bg-[#66586D] text-white shadow-sm' 
                                    : 'bg-background text-foreground'" 
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-full px-3 py-1.5 text-sm font-medium transition-all focus:outline-none focus:ring-0">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <x-status-badge status="menunggu_validasi" />
                        <x-status-badge status="revisi" />
                        <x-status-badge status="validated" />
                        <x-status-badge status="draft" />
                    </div>
                </div>

                <!-- Kriteria List -->
                <div class="mt-6 grid gap-4">
                    @if(isset($filteredKriteria) && count($filteredKriteria) > 0)
                        @foreach($filteredKriteria as $kriteria)
                            @if($kriteria)
                                @include('components.validator-kriteria-card', ['criteria' => $kriteria])
                            @endif
                        @endforeach
                    @else
                        <div class="text-center py-12 bg-white rounded-lg border">
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

                <!-- Summary -->
                @if(isset($filteredKriteria) && count($filteredKriteria) > 0)
                    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white rounded-lg border p-4">
                        <div class="text-sm text-gray-700 mb-2 sm:mb-0">
                            Menampilkan <span class="font-medium">{{ count($filteredKriteria) }}</span> dari <span class="font-medium">{{ count($allKriteria ?? []) }}</span> kriteria
                        </div>
                        <div class="text-sm text-blue-600 font-medium">
                            @if($activeTab === 'validation')
                                {{ $pendingValidation ?? 0 }} menunggu validasi Anda
                            @elseif($activeTab === 'revision')
                                {{ $needsRevision ?? 0 }} perlu tindak lanjut
                            @elseif($activeTab === 'validated')
                                {{ $validated ?? 0 }} telah selesai divalidasi
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>


@endsection