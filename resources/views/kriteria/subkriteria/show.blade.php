@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <a href="{{ route('kriteria.show', $kriteriaId) }}" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-9 w-9">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                        <path d="m12 19-7-7 7-7"></path>
                        <path d="M19 12H5"></path>
                    </svg>
                </a>
                <div class="flex-1">
                    <h1 class="text-2xl font-bold">
                        {{ $subKriteria['urutan'] }}. {{ $subKriteria['nama_subkriteria'] }}
                    </h1>
                    <p class="text-sm text-muted-foreground">Kriteria {{ $kriteriaId }}</p>
                </div>
                <x-status-badge :status="$subKriteria['status']" />
            </div>

            <div x-data="{ activeTab: 'content' }">
                <div class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground">
                    <button @click="activeTab = 'content'" :class="{ 'bg-background text-foreground shadow-sm': activeTab === 'content' }" class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                        Konten
                    </button>
                    <button @click="activeTab = 'attachments'" :class="{ 'bg-background text-foreground shadow-sm': activeTab === 'attachments' }" class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                        Lampiran
                    </button>
                    <button @click="activeTab = 'validation'" :class="{ 'bg-background text-foreground shadow-sm': activeTab === 'validation' }" class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                        Validasi
                    </button>
                </div>

                <!-- Content Tab -->
                <div x-show="activeTab === 'content'" class="mt-6">
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold">Isi Sub-kriteria</h2>
                            <p class="text-sm text-muted-foreground">
                                {{ $subKriteria['status'] === 'validated' ? 'Konten ini telah divalidasi dan tidak dapat diubah.' : 'Masukkan informasi sesuai dengan panduan akreditasi.' }}
                            </p>
                        </div>
                        <div class="p-6 pt-0">
                            <textarea 
                                placeholder="Masukkan konten sub-kriteria di sini..."
                                class="flex min-h-[200px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                {{ $subKriteria['status'] === 'validated' ? 'disabled' : '' }}
                            >{{ $akreditasi['isi'] }}</textarea>
                        </div>
                        @if($akreditasi['komentar'])
                        <div class="p-6 pt-0 border-t">
                            <div class="rounded-lg bg-amber-50 p-4 text-amber-800 text-sm">
                                <div class="font-semibold mb-1">Komentar Validator:</div>
                                {{ $akreditasi['komentar'] }}
                            </div>
                        </div>
                        @endif
                        <div class="p-6 pt-0 border-t">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                                <div class="text-sm text-muted-foreground">
                                    {{ $akreditasi['updated_at'] ? 'Terakhir diperbarui: ' . $akreditasi['updated_at'] : '' }}
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @if($subKriteria['status'] !== 'validated')
                                        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2">
                                            Simpan Draft
                                        </button>
                                        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2">
                                            Simpan & Kirim
                                        </button>
                                    @endif
                                    @if($subKriteria['status'] === 'menunggu_validasi')
                                        @include('components.validation-dialog')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attachments Tab -->
                <div x-show="activeTab === 'attachments'" class="mt-6">
                    @include('components.file-upload', [
                        'existingFile' => $akreditasi['file_path'],
                        'isDisabled' => $subKriteria['status'] === 'validated'
                    ])
                </div>

                <!-- Validation Tab -->
                <div x-show="activeTab === 'validation'" class="mt-6">
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold">Status Validasi</h2>
                            <p class="text-sm text-muted-foreground">Informasi validasi untuk sub-kriteria ini.</p>
                        </div>
                        <div class="p-6 pt-0">
                            @if($subKriteria['status'] === 'validated')
                                <div class="rounded-lg border p-4">
                                    <div class="flex items-center gap-2 text-green-600 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                            <path d="m9 12 2 2 4-4"></path>
                                        </svg>
                                        <span class="font-semibold">Tervalidasi</span>
                                    </div>
                                    <div class="grid gap-2 text-sm">
                                        <div class="grid grid-cols-3">
                                            <span class="font-medium">Validator Terakhir:</span>
                                            <span class="col-span-2">
                                                {{ count($validasiLogs) > 0 ? $validasiLogs[0]['peran_validator'] . ' (' . $validasiLogs[0]['created_at'] . ')' : '-' }}
                                            </span>
                                        </div>
                                        <div class="grid grid-cols-3">
                                            <span class="font-medium">Catatan:</span>
                                            <span class="col-span-2">{{ count($validasiLogs) > 0 ? $validasiLogs[0]['komentar'] : '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @elseif($subKriteria['status'] === 'menunggu_validasi')
                                <div class="rounded-lg border p-4">
                                    <div class="flex items-center gap-2 text-blue-600 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <span class="font-semibold">Menunggu Validasi</span>
                                    </div>
                                    <p class="text-sm text-muted-foreground">
                                        Sub-kriteria ini telah diselesaikan dan sedang menunggu validasi dari KPS/Kajur.
                                    </p>
                                </div>
                            @elseif($subKriteria['status'] === 'revisi')
                                <div class="rounded-lg border p-4">
                                    <div class="flex items-center gap-2 text-amber-600 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                        </svg>
                                        <span class="font-semibold">Perlu Revisi</span>
                                    </div>
                                    <p class="text-sm text-muted-foreground">
                                        Sub-kriteria ini perlu direvisi berdasarkan komentar validator.
                                    </p>
                                </div>
                            @else
                                <div class="rounded-lg border p-4">
                                    <div class="flex items-center gap-2 text-muted-foreground mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                            <path d="M18 6 6 18"></path>
                                            <path d="m6 6 12 12"></path>
                                        </svg>
                                        <span class="font-semibold">Belum Divalidasi</span>
                                    </div>
                                    <p class="text-sm text-muted-foreground">
                                        Sub-kriteria ini belum selesai atau belum dikirim untuk validasi.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-muted-foreground">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0-18 0"></path>
                            <path d="M12 8v4"></path>
                            <path d="M12 16h.01"></path>
                        </svg>
                        <h3 class="text-lg font-semibold">Riwayat Validasi</h3>
                    </div>

                    @include('components.validation-history', ['logs' => $validasiLogs])
                </div>
            </div>
        </div>
    </main>
</div>
@endsection