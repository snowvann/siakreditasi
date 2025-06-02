<!-- resources/views/components/validator-kriteria-card.blade.php -->
@props([
    'criteria' => null,
    'onViewDetails' => route('validator.kriteria.show', ['id' => $kriteria->id]),
])

@php
    $statusConfig = [
        'validated' => [
            'label' => 'Tervalidasi',
            'color' => 'bg-green-100 text-green-800',
            'icon' => 'check-circle',
        ],
        'menunggu_validasi' => [
            'label' => 'Menunggu Validasi',
            'color' => 'bg-yellow-100 text-yellow-800',
            'icon' => 'clock',
        ],
        'revisi' => [
            'label' => 'Perlu Revisi',
            'color' => 'bg-red-100 text-red-800',
            'icon' => 'alert-circle',
        ],
        'draft' => [
            'label' => 'Draft',
            'color' => 'bg-gray-100 text-gray-800',
            'icon' => 'edit-3',
        ],
    ];

    $config = $statusConfig[$criteria->status] ?? $statusConfig['draft'];
@endphp

<div class="rounded-lg border bg-card text-card-foreground shadow-sm mb-4 hover:shadow-md transition-shadow">
    <div class="p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex-1">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-semibold text-lg text-gray-900">
                        Kriteria {{ $criteria->id }}: {{ $criteria->nama_kriteria }}
                    </h3>
                    <span class="{{ $config['color'] }} border-0 font-medium inline-flex items-center rounded-full px-3 py-1 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 mr-1">
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

                @if(isset($criteria->description))
                    <p class="text-sm text-gray-600 mb-3">{{ $criteria->description }}</p>
                @endif

                <div class="flex flex-col sm:flex-row sm:items-center gap-4 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>{{ $criteria->assignee ?? 'Belum ditentukan' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                            <line x1="16" x2="16" y1="2" y2="6"></line>
                            <line x1="8" x2="8" y1="2" y2="6"></line>
                            <line x1="3" x2="21" y1="10" y2="10"></line>
                        </svg>
                        <span>Terakhir diperbarui: {{ $criteria->lastUpdated ?? 'Belum ada data' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span>Progress</span>
                        <span class="font-medium">{{ $criteria->progress }}%</span>
                    </div>
                    <div class="relative w-full h-2 rounded-full overflow-hidden bg-gray-200">
                        <div class="absolute top-0 left-0 h-full bg-blue-600" style="width: {{ $criteria->progress }}%"></div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2 lg:flex-col lg:gap-3">
                <button onclick="{{ $onViewDetails ? 'window.location.href=\''.$onViewDetails.'\'' : '#' }}" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 flex-1 lg:flex-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    Lihat
                </button>
                <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 flex-1 lg:flex-none">
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
