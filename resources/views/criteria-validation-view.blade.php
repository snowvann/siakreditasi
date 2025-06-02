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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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
                            Kriteria
                        </button>
                    </nav>

                    <div class="flex items-center gap-3">
                        <div class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
                            <img src="/placeholder.svg" alt="Avatar" class="aspect-square h-full w-full" />
                            <span class="flex h-full w-full items-center justify-center rounded-full bg-muted">GX</span>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-sm font-medium">Gustavo Xavier</p>
                            <p class="text-xs text-gray-500">Anggota Kriteria 1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-6">
        <!-- Back Button and Title -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <button onclick="window.history.back()" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none ring-offset-background hover:bg-accent hover:text-accent-foreground h-9 px-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </button>
                <div>
                    <h1 class="text-2xl font-bold flex items-center gap-3">
                        Kriteria {{ $criteria->id }}: {{ $criteria->nama_kriteria }}
                        @include('components.status-badge', ['status' => $criteria->status])
                    </h1>
                    <p class="text-gray-600 mt-1">
                        Deskripsi lengkap untuk kriteria ini yang menjelaskan apa yang perlu diisi.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Left Sidebar -->
            <div class="lg:col-span-1 space-y-4">
                <!-- Anggota Kriteria Card -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                        <h3 class="text-base font-semibold pb-3">Anggota Kriteria</h3>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="font-medium">{{ $criteria->assignee }}</span>
                        </div>
                    </div>
                </div>

                <!-- Terakhir Diperbarui Card -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                        <h3 class="text-base font-semibold pb-3">Terakhir Diperbarui</h3>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium">{{ $criteria->lastUpdated }}</span>
                        </div>
                    </div>
                </div>

                <!-- Validasi Section -->
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                        <h3 class="text-base font-semibold pb-3">Validasi</h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="approve" name="validationAction" value="approve" class="peer h-4 w-4 border border-gray-300 rounded-full text-green-600 focus:ring-green-600" />
                                <label for="approve" class="flex items-center gap-2 cursor-pointer">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Setujui</span>
                                </label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="reject" name="validationAction" value="reject" class="peer h-4 w-4 border border-gray-300 rounded-full text-red-600 focus:ring-red-600" />
                                <label for="reject" class="flex items-center gap-2 cursor-pointer">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span>Tolak</span>
                                </label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="revise" name="validationAction" value="revise" class="peer h-4 w-4 border border-gray-300 rounded-full text-yellow-600 focus:ring-yellow-600" />
                                <label for="revise" class="flex items-center gap-2 cursor-pointer">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Minta Revisi</span>
                                </label>
                            </div>

                            <div>
                                <label for="comment" class="text-sm font-medium mb-1 block">
                                    Komentar Validasi
                                </label>
                                <textarea
                                    id="comment"
                                    placeholder="Masukkan komentar validasi..."
                                    class="flex min-h-[120px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                ></textarea>
                            </div>

                            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none ring-offset-background bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full">
                                Simpan Validasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content - PDF Viewer -->
            <div class="lg:col-span-3">
                @include('components.pdf-viewer', ['criteria' => $criteria])
            </div>
        </div>
    </main>
</div>
@endsection