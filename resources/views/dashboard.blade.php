@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold">Dashboard Akreditasi</h1>
                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
                    Lihat PDF Lengkap
                </button>
            </div>

            <!-- Statistik Cards -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                @php
                    $totalKriteria = 9;
                    $completedKriteria = 3;
                    $validatedKriteria = 2;
                @endphp

                <!-- Card Total Kriteria -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
                        <h3 class="text-sm font-medium">Total Kriteria</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-muted-foreground">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <path d="M16 13a2 2 0 0 1-2 2H3"></path>
                            <path d="M8 13a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2"></path>
                        </svg>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="text-3xl font-bold">{{ $totalKriteria }}</div>
                        <p class="text-xs text-muted-foreground">9 kriteria harus diisi</p>
                    </div>
                </div>

                <!-- Card Kriteria Terisi -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
                        <h3 class="text-sm font-medium">Kriteria Terisi</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-muted-foreground">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="text-3xl font-bold">{{ $completedKriteria }}</div>
                        <p class="text-xs text-muted-foreground">dari {{ $totalKriteria }} kriteria</p>
                    </div>
                </div>

                <!-- Card Kriteria Tervalidasi -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
                        <h3 class="text-sm font-medium">Kriteria Tervalidasi</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-muted-foreground">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="text-3xl font-bold">{{ $validatedKriteria }}</div>
                        <p class="text-xs text-muted-foreground">dari {{ $totalKriteria }} kriteria</p>
                    </div>
                </div>

                <!-- Card Total Anggota -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
                        <h3 class="text-sm font-medium">Total Anggota</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-muted-foreground">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="text-3xl font-bold">12</div>
                        <p class="text-xs text-muted-foreground">Anggota aktif</p>
                    </div>
                </div>
            </div>

            <!-- Progress Card -->
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
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
                            <div class="h-full w-full flex-1 bg-primary transition-all" style="width: {{ ($completedKriteria / $totalKriteria) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Kriteria -->
            <div x-data="{ activeTab: 'all' }">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground">
                        <button @click="activeTab = 'all'" :class="{ 'bg-background text-foreground shadow-sm': activeTab === 'all' }" class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                            Semua Kriteria
                        </button>
                        <button @click="activeTab = 'assigned'" :class="{ 'bg-background text-foreground shadow-sm': activeTab === 'assigned' }" class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                            Ditugaskan Kepada Saya
                        </button>
                        <button @click="activeTab = 'validation'" :class="{ 'bg-background text-foreground shadow-sm': activeTab === 'validation' }" class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                            Menunggu Validasi
                        </button>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <x-status-badge status="validated" />
                        <x-status-badge status="menunggu_validasi" />
                        <x-status-badge status="revisi" />
                        <x-status-badge status="draft" />
                    </div>
                </div>

                <!-- Tab Content - All -->
                <div x-show="activeTab === 'all'" class="mt-6">
                    <div class="grid gap-4">
                        @foreach([
                            ['id' => 1, 'nama_kriteria' => 'Visi, Misi, Tujuan dan Strategi', 'status' => 'validated', 'progress' => 100],
                            ['id' => 2, 'nama_kriteria' => 'Tata Pamong, Tata Kelola dan Kerjasama', 'status' => 'validated', 'progress' => 100],
                            ['id' => 3, 'nama_kriteria' => 'Mahasiswa', 'status' => 'menunggu_validasi', 'progress' => 100],
                            ['id' => 4, 'nama_kriteria' => 'Sumber Daya Manusia', 'status' => 'revisi', 'progress' => 60],
                            ['id' => 5, 'nama_kriteria' => 'Keuangan, Sarana dan Prasarana', 'status' => 'draft', 'progress' => 40],
                            ['id' => 6, 'nama_kriteria' => 'Pendidikan', 'status' => 'draft', 'progress' => 0],
                            ['id' => 7, 'nama_kriteria' => 'Penelitian', 'status' => 'draft', 'progress' => 0],
                            ['id' => 8, 'nama_kriteria' => 'Pengabdian kepada Masyarakat', 'status' => 'draft', 'progress' => 0],
                            ['id' => 9, 'nama_kriteria' => 'Luaran dan Capaian Tridharma', 'status' => 'draft', 'progress' => 0],
                        ] as $kriteria)
                            <x-kriteria-card :kriteria="$kriteria" />
                        @endforeach
                    </div>
                </div>

                <!-- Tab Content - Assigned -->
                <div x-show="activeTab === 'assigned'" class="mt-6">
                    <div class="grid gap-4">
                        @foreach([
                            ['id' => 1, 'nama_kriteria' => 'Visi, Misi, Tujuan dan Strategi', 'status' => 'validated', 'progress' => 100],
                            ['id' => 2, 'nama_kriteria' => 'Tata Pamong, Tata Kelola dan Kerjasama', 'status' => 'validated', 'progress' => 100],
                            ['id' => 3, 'nama_kriteria' => 'Mahasiswa', 'status' => 'menunggu_validasi', 'progress' => 100],
                        ] as $kriteria)
                            <x-kriteria-card :kriteria="$kriteria" />
                        @endforeach
                    </div>
                </div>

                <!-- Tab Content - Validation -->
                <div x-show="activeTab === 'validation'" class="mt-6">
                    <div class="grid gap-4">
                        @foreach([
                            ['id' => 3, 'nama_kriteria' => 'Mahasiswa', 'status' => 'menunggu_validasi', 'progress' => 100],
                        ] as $kriteria)
                            <x-kriteria-card :kriteria="$kriteria" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection