@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('superadmin.dashboard') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Riwayat Isian
            </a>
        </div>

        

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pengisian</p>
                        <p class="text-3xl font-bold text-indigo-600">{{ number_format($stats['total_isian']) }}</p>
                    </div>
                    <div class="p-3 bg-indigo-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

     

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Aktivitas Terakhir</p>
                        <p class="text-lg font-bold text-purple-600">{{ $stats['last_activity'] ?? 'Belum ada' }}</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

     
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kriteria</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Kriteria</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Update</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($isian as $index => $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ ($isian->currentPage() - 1) * $isian->perPage() + $index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->subkriteria->kriteria->nama_kriteria ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($item->subkriteria->kriteria->deskripsi ?? '', 60) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->subkriteria->nama_subkriteria ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($item->subkriteria->deskripsi ?? '', 60) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        @if(strlen($item->nilai ?? '') > 150)
                                            <div class="text-sm text-gray-900">
                                                <div class="expandable-content" data-full-text="{{ $item->nilai }}">
                                                    <div class="truncated-text">{{ Str::limit($item->nilai, 150) }}</div>
                                                    <button class="text-indigo-600 hover:text-indigo-800 text-xs font-medium mt-1 expand-btn">
                                                        Lihat Selengkapnya
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-900">{{ $item->nilai ?? 'N/A' }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>{{ $item->updated_at ? $item->updated_at->format('d M Y') : 'N/A' }}</div>
                                    <div class="text-xs">{{ $item->updated_at ? $item->updated_at->format('H:i') : '' }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-lg font-medium">Belum ada pengisian</p>
                                        <p class="text-sm">User ini belum mengisi kriteria apapun</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($isian->hasPages())
                <div class="bg-white px-6 py-4 border-t border-gray-200">
                    {{ $isian->links() }}
                </div>
            @endif
        </div>
    </main>
</div>

<!-- Modal for full text display -->
<div id="textModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-96 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Detail Nilai</h3>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-6 overflow-y-auto max-h-80">
                <div id="modalContent" class="text-sm text-gray-900 whitespace-pre-wrap"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle expand text functionality
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('textModal');
        const modalContent = document.getElementById('modalContent');
        const closeModal = document.getElementById('closeModal');

        // Expand button click handler
        document.querySelectorAll('.expand-btn').forEach(button => {
            button.addEventListener('click', function() {
                const fullText = this.closest('.expandable-content').getAttribute('data-full-text');
                modalContent.textContent = fullText;
                modal.classList.remove('hidden');
            });
        });

        // Close modal handlers
        closeModal.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });

        // ESC key handler
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
@endsection