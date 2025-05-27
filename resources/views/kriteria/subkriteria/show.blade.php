@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">

            {{-- Header dengan tombol kembali, judul, status --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <a href="{{ route('kriteria.show', $kriteriaId) }}" 
                   class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium 
                          ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 
                          focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                          hover:bg-accent hover:text-accent-foreground h-9 w-9">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                         class="h-4 w-4">
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

            {{-- Tabs --}}
            <div x-data="{ activeTab: 'content' }">
                <div class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground">
                    <button 
                        @click="activeTab = 'content'" 
                        :class="{ 'bg-background text-foreground shadow-sm': activeTab === 'content' }" 
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium 
                               ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring 
                               focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                        Konten
                    </button>
                    <button 
                        @click="activeTab = 'attachments'" 
                        :class="{ 'bg-background text-foreground shadow-sm': activeTab === 'attachments' }" 
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium 
                               ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring 
                               focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                        Lampiran
                    </button>
                </div>

                {{-- Content Tab --}}
                <div x-show="activeTab === 'content'" class="mt-6">
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold">Isi Sub-kriteria</h2>
                            <p class="text-sm text-muted-foreground">
                                {{ $subKriteria['status'] === 'validated' 
                                    ? 'Konten ini telah divalidasi dan tidak dapat diubah.' 
                                    : 'Masukkan informasi sesuai dengan panduan akreditasi.' 
                                }}
                            </p>
                        </div>
                        <div class="min-h-[200px] bg-gray-50 px-6 pb-6">
                            <textarea 
                                placeholder="Masukkan konten sub-kriteria di sini..."
                                class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm 
                                       ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none 
                                       focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed 
                                       disabled:opacity-50"
                                {{ $subKriteria['status'] === 'validated' ? 'disabled' : '' }}>
                                {{ $akreditasi['isi'] }}
                            </textarea>
                        </div>

                        <div class="p-6 pt-0 border-t">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                                <div class="text-sm text-muted-foreground">
                                    {{ $akreditasi['updated_at'] ? 'Terakhir diperbarui: ' . $akreditasi['updated_at'] : '' }}
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @if($subKriteria['status'] !== 'validated')
                                        <button 
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium 
                                                   ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 
                                                   focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                                                   border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2">
                                            Simpan Draft
                                        </button>
                                        <button 
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium 
                                                   ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 
                                                   focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                                                   bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2">
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

                {{-- Attachments Tab --}}
                <div x-show="activeTab === 'attachments'" class="mt-6">
                    @include('components.file-upload', [
                        'existingFile' => $akreditasi['file_path'],
                        'isDisabled' => $subKriteria['status'] === 'validated'
                    ])
                </div>
            </div>

        </div>
    </main>
</div>
@endsection
