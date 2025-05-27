@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">
            <!-- Header dan Search -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h1 class="text-3xl font-bold flex-shrink-0">Kriteria</h1>
            
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
                                placeholder="Cari kriteria atau subkriteria..."
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                        </div>
                    </form>
                </div>
            </div>
            

            <!-- Progress Card -->
            @php
                $totalKriteria = 9;
                $completedKriteria = 3;
                $validatedKriteria = 2;
                $allKriteria = [
                    ['id' => 1, 'nama_kriteria' => 'Visi, Misi, Tujuan dan Strategi', 'status' => 'validated', 'progress' => 100],
                    ['id' => 2, 'nama_kriteria' => 'Tata Pamong, Tata Kelola dan Kerjasama', 'status' => 'validated', 'progress' => 100],
                    ['id' => 3, 'nama_kriteria' => 'Mahasiswa', 'status' => 'menunggu_validasi', 'progress' => 100],
                    ['id' => 4, 'nama_kriteria' => 'Sumber Daya Manusia', 'status' => 'revisi', 'progress' => 60],
                    ['id' => 5, 'nama_kriteria' => 'Keuangan, Sarana dan Prasarana', 'status' => 'draft', 'progress' => 40],
                    ['id' => 6, 'nama_kriteria' => 'Pendidikan', 'status' => 'draft', 'progress' => 0],
                    ['id' => 7, 'nama_kriteria' => 'Penelitian', 'status' => 'draft', 'progress' => 0],
                    ['id' => 8, 'nama_kriteria' => 'Pengabdian kepada Masyarakat', 'status' => 'draft', 'progress' => 0],
                    ['id' => 9, 'nama_kriteria' => 'Luaran dan Capaian Tridharma', 'status' => 'draft', 'progress' => 0],
                ];
            @endphp

            <div class="rounded-lg border text-card-foreground shadow-sm" style="background: linear-gradient(to top, rgba(0, 0, 0, 0.1), transparent), #EFDDFF;">
                <div class="p-6">
                    <h2 class="text-lg font-semibold">Progress Akreditasi</h2>
                    <p class="text-sm text-muted-foreground">Progress pengisian dan validasi kriteria akreditasi</p>
                </div>
                <div class="p-6 pt-0">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <div>Progress Keseluruhan</div>
                            <div class="font-medium">{{ round(($completedKriteria / $totalKriteria) * 100) }}%</div>
                        </div>
                        <div class="relative h-2 w-full overflow-hidden rounded-full bg-secondary">
                            <div class="h-full bg-primary transition-all" style="width: {{ ($completedKriteria / $totalKriteria) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div x-data="{ activeTab: 'all' }">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground">
                        @foreach([
                            'all' => 'Semua Kriteria',
                            'assigned' => 'Ditugaskan Kepada Saya',
                            'validation' => 'Menunggu Validasi'
                        ] as $key => $label)
                            <button 
                                @click="activeTab = '{{ $key }}'" 
                                :class="activeTab === '{{ $key }}'
                                    ? 'bg-[#66586D] text-white shadow-sm' 
                                    : 'bg-background text-foreground'" 
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-full px-3 py-1.5 text-sm font-medium transition-all focus:outline-none focus:ring-0">
                                {{ $label }}
                            </button>
                        @endforeach
                        
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <x-status-badge status="validated" />
                        <x-status-badge status="menunggu_validasi" />
                        <x-status-badge status="revisi" />
                        <x-status-badge status="draft" />
                    </div>
                </div>

                <!-- Tab Panels -->
                <div class="mt-6 grid gap-4">
                    <template x-if="activeTab === 'all'">
                        <div>
                            @foreach($allKriteria as $kriteria)
                                <x-kriteria-card :kriteria="$kriteria" />
                            @endforeach
                        </div>
                    </template>

                    <template x-if="activeTab === 'assigned'">
                        <div>
                            @foreach($allKriteria as $kriteria)
                                @if(in_array($kriteria['id'], [1, 2, 3])) {{-- contoh logika --}}
                                    <x-kriteria-card :kriteria="$kriteria" />
                                @endif
                            @endforeach
                        </div>
                    </template>

                    <template x-if="activeTab === 'validation'">
                        <div>
                            @foreach($allKriteria as $kriteria)
                                @if($kriteria['status'] === 'menunggu_validasi')
                                    <x-kriteria-card :kriteria="$kriteria" />
                                @endif
                            @endforeach
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
