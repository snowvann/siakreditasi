@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.validator-header')

    <main class="container mx-auto px-4 py-6">
        <!-- Header with Back Button and Title -->
        <div class="flex items-center gap-4 mb-6">
            <button 
                onclick="window.history.back()" 
                class="inline-flex items-center justify-center w-8 h-8 text-gray-600 hover:text-gray-900 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </button>
            
            <div class="flex-1">
                <h1 class="text-xl font-semibold text-gray-900 flex items-center gap-3">
                    Kriteria {{ $kriteria->id }}: {{ $kriteria->nama_kriteria }}
                    @include('components.status-badge', ['status' => $kriteria->status])
                </h1>
                <p class="text-sm text-gray-600 mt-1">
                    {{ $kriteria->description ?? 'Deskripsi lengkap untuk kriteria ini yang menjelaskan apa yang perlu diisi.' }}
                </p>
            </div>

            <!-- Plan Revisi Button -->
            <button class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-orange-700 bg-orange-50 border border-orange-200 rounded-lg hover:bg-orange-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Plan Revisi
            </button>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <!-- Left Sidebar -->
            <div class="col-span-12 lg:col-span-3 space-y-4">
                
                <!-- Anggota Kriteria -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">Anggota Kriteria</h3>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">{{ $kriteria->assignee ?? 'Dr. Budi Santoso, M.Pd.' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Terakhir Diperbarui -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">Terakhir Diperbarui</h3>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">{{ $kriteria->lastUpdated ?? '26 Mei 2025' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Validasi Section -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-4">Validasi</h3>
                        
                        <form class="space-y-4">
                            <!-- Validation Comment -->
                            <div>
                                <label class="text-xs text-gray-600 mb-2 block">
                                    Isi kriteria ini sesuai diperlukan setelah sesuai dengan ketentuan yang ada dalam dokumen panduan.
                                </label>
                                <label class="text-xs text-gray-600 mb-3 block">
                                    Gunakan panduan kriteria ini tidak lengkap dan sesuaikan.
                                </label>
                                <textarea
                                    placeholder="Tambahkan komentar..."
                                    class="w-full h-24 px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                ></textarea>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <button 
                                    type="button"
                                    class="flex-1 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                                >
                                    Simpan
                                </button>
                            </div>

                            <!-- Validation Status Buttons -->
                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button 
                                    type="button"
                                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors"
                                >
                                    Valid
                                </button>
                                <button 
                                    type="button"
                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors"
                                >
                                    Revisi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content - PDF Viewer -->
            <div class="col-span-12 lg:col-span-9">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                    </div>

                    <!-- PDF Viewer Content -->
                    <div class="pdf-viewer-wrapper">
                        @include('components.pdf-viewer', ['kriteria' => $kriteria, 'pdfUrl' => $pdfUrl ?? null])
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
/* PDF Viewer Wrapper Styling */
.pdf-viewer-wrapper {
    min-height: 600px;
    background: #f8fafc;
    border-radius: 0 0 0.5rem 0.5rem;
}

.pdf-viewer-wrapper iframe,
.pdf-viewer-wrapper embed,
.pdf-viewer-wrapper object {
    width: 100%;
    min-height: 600px;
    border: none;
    border-radius: 0 0 0.5rem 0.5rem;
    box-shadow: inset 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

/* Enhanced container styling */
.pdf-viewer-wrapper > * {
    border-radius: 0 0 0.5rem 0.5rem;
    overflow: hidden;
}

/* Custom scrollbar for PDF content */
.pdf-viewer-wrapper::-webkit-scrollbar {
    width: 8px;
}

.pdf-viewer-wrapper::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

.pdf-viewer-wrapper::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.pdf-viewer-wrapper::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
@endsection