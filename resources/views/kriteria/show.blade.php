@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-9 w-9">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                        <path d="m12 19-7-7 7-7"></path>
                        <path d="M19 12H5"></path>
                    </svg>
                </a>
                <div class="flex-1">
                    <h1 class="text-2xl font-bold">
                        {{ $kriteriaData['nama_kriteria'] }}
                    </h1>
                    <p class="text-sm text-muted-foreground">{{ $kriteriaData['deskripsi'] }}</p>
                </div>
                <x-status-badge :status="$kriteriaData['status']" />
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <!-- Anggota Kriteria Card -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-6 pb-2">
                        <h3 class="text-sm font-medium">Anggota Kriteria</h3>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-muted-foreground">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <div class="text-sm">
                                {{ implode(', ', array_column($anggotaKriteria, 'name')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Last Updated Card -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-6 pb-2">
                        <h3 class="text-sm font-medium">Terakhir Diperbarui</h3>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="font-medium">{{ $kriteriaData['updated_at'] }}</div>
                    </div>
                </div>

                <!-- Progress Card -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-6 pb-2">
                        <h3 class="text-sm font-medium">Progress</h3>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="space-y-2">
                            <div class="relative h-2 w-full overflow-hidden rounded-full bg-secondary">
                                <div class="h-full w-full flex-1 bg-primary transition-all" style="width: {{ $kriteriaData['progress'] }}%"></div>
                            </div>
                            <div class="text-sm text-muted-foreground">{{ $kriteriaData['progress'] }}% selesai</div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ tab: 'subkriteria' }" x-cloak class="space-y-4">
                    <!-- Tab Selector + Tombol PDF -->
                    <div class="flex flex-wrap items-center justify-between border-b pb-1">
                        <div class="flex gap-2 bg-muted p-1 rounded-md">
                            <button @click="tab = 'subkriteria'"
                                :class="tab === 'subkriteria' 
                                    ? 'bg-[#66586D] text-white shadow-sm' 
                                    : 'bg-background text-foreground'"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-full px-3 py-1.5 text-sm font-medium transition-all focus:outline-none focus:ring-0">
                                Sub-kriteria
                            </button>
                            <button @click="tab = 'validasi'"
                                :class="tab === 'validasi' 
                                    ? 'bg-[#66586D] text-white shadow-sm' 
                                    : 'bg-background text-foreground'"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-full px-3 py-1.5 text-sm font-medium transition-all focus:outline-none focus:ring-0">
                                Validasi
                            </button>
                        </div>

                                                    <!-- Tombol PDF -->
                                                    <a href="{{ route('kriteria.unduh-pdf', $kriteriaId) }}" 
                                                    class="inline-flex items-center gap-2 rounded-md bg-[#D28D0D] text-white px-4 py-1 text-sm font-semibold shadow-sm hover:opacity-90 transition"
                                                    target="_blank" rel="noopener noreferrer">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                         <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                         <polyline points="7 10 12 15 17 10" />
                                                         <line x1="12" y1="15" x2="12" y2="3" />
                                                     </svg>
                                                     <span>Unduh PDF</span>
                                                 </a>
                                                 

                    </div>


                <!-- Subkriteria Content -->
                <div x-show="tab === 'subkriteria'" x-cloak class="grid gap-4">
                    @foreach($subKriteriaList as $subKriteria)
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                        <div class="flex items-center justify-between p-6">
                            <div class="flex items-center gap-4">
                                <div>
                                    <h2 class="font-medium">{{ $subKriteria['nama_subkriteria'] }}</h2>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-status-badge :status="$subKriteria['status']" />
                                <a href="{{ url('kriteria/'.$kriteriaId.'/sub-kriteria/'.$subKriteria['id']) }}"
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium hover:bg-accent hover:text-accent-foreground h-9 w-9">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            
                <!-- Validasi Content -->
                <div x-show="tab === 'validasi'" x-cloak class="border rounded-md p-4 text-sm text-gray-600">
                    Konten validasi akan ditampilkan di sini.
                </div>
            </div>
            


        </div>
    </main>
</div>
@endsection