<!-- resources/views/components/validator-kriteria-card.blade.php -->
@props([
    'criteria' => null,
    'onViewDetails' => route('validator.kriteria.show', ['id' => $kriteria->id]),
])

@php
    $statusConfig = [
        'validated' => [
            'label' => 'Tervalidasi',
            'color' => 'bg-green-100 text-green-800 border-green-200',
            'icon' => 'check-circle',
        ],
        'menunggu_validasi' => [
            'label' => 'Menunggu Validasi',
            'color' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            'icon' => 'clock',
        ],
        'revisi' => [
            'label' => 'Perlu Revisi',
            'color' => 'bg-red-100 text-red-800 border-red-200',
            'icon' => 'alert-circle',
        ],
        'draft' => [
            'label' => 'Draft',
            'color' => 'bg-gray-100 text-gray-800 border-gray-200',
            'icon' => 'edit-3',
        ],
    ];

    $config = $statusConfig[$criteria->status] ?? $statusConfig['draft'];
@endphp

<div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 mb-6">
    <div class="p-6">
        <!-- Header dengan Judul dan Status -->
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1 min-w-0">
                <h3 class="text-xl font-semibold text-gray-900 mb-1 pr-4">
                    {{ $criteria->nama_kriteria }}
                </h3>
                @if(isset($criteria->description))
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $criteria->description }}
                    </p>
                @endif
            </div>
            
            <!-- Status Badge -->
            <div class="flex-shrink-0">
                <span class="{{ $config['color'] }} border font-medium inline-flex items-center rounded-lg px-3 py-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                        @if($config['icon'] === 'check-circle')
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        @elseif($config['icon'] === 'clock')
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        @elseif($config['icon'] === 'alert-circle')
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" x2="12" y1="8" y2="12"></line>
                            <line x1="12" x2="12.01" y1="16" y2="16"></line>
                        @elseif($config['icon'] === 'edit-3')
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        @endif
                    </svg>
                    {{ $config['label'] }}
                </span>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-100 my-4"></div>

        <!-- Metadata dan Actions -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Metadata -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-6 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-500">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500 uppercase tracking-wider">Assignee</div>
                        <div class="font-medium text-gray-900">{{ $criteria->assignee ?? 'Belum ditentukan' }}</div>
                    </div>
                </div>
                
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-500">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <line x1="16" x2="16" y1="2" y2="6"></line>
                            <line x1="8" x2="8" y1="2" y2="6"></line>
                            <line x1="3" x2="21" y1="10" y2="10"></line>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500 uppercase tracking-wider">Terakhir Diperbarui</div>
                        <div class="font-medium text-gray-900">{{ $criteria->lastUpdated ?? 'Belum ada data' }}</div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 lg:flex-shrink-0">
                <button 
                    onclick="{{ $onViewDetails ? 'window.location.href=\''.$onViewDetails.'\'' : '#' }}" 
                    class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    Lihat Detail
                </button>
                
                <button class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 hover:border-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" x2="12" y1="15" y2="3"></line>
                    </svg>
                    Unduh
                </button>
            </div>
        </div>
    </div>
</div>