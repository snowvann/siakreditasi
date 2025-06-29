@props([
    'status' => 'draft',
    'size' => 'md', // sm, md, lg (default: md)
    'iconPosition' => 'left', // left, right (default: left)
    'showIcon' => true, // true, false (default: true)
])

@php
    $classes = [
        'validated' => 'bg-green-100 text-green-800 hover:bg-green-100 hover:text-green-800',
        'menunggu_validasi' => 'bg-blue-100 text-blue-800 hover:bg-blue-100 hover:text-blue-800',
        'revisi' => 'bg-amber-100 text-amber-800 hover:bg-amber-100 hover:text-amber-800',
        'draft' => 'border border-gray-300 text-gray-500',
    ];

    $icons = [
        'validated' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>',
        'menunggu_validasi' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>',
        'revisi' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m12 8 4 4"/><path d="m16 12-4 4"/></svg>',
        'draft' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
    ];

    $labels = [
        'validated' => 'Tervalidasi',
        'menunggu_validasi' => 'Menunggu Validasi',
        'revisi' => 'Perlu Revisi',
        'draft' => 'Draft',
    ];

    // Size configuration
    $sizeClasses = [
        'sm' => 'text-xs px-2 py-0.5',
        'md' => 'text-sm px-2.5 py-1',
        'lg' => 'text-base px-3 py-1.5',
    ];

    $iconSizeClasses = [
        'sm' => 'h-3 w-3',
        'md' => 'h-4 w-4',
        'lg' => 'h-5 w-5',
    ];

    $baseClass = 'inline-flex items-center rounded-full font-medium';
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $iconClass = $iconSizeClasses[$size] ?? $iconSizeClasses['md'];
    $iconMarginClass = $iconPosition === 'left' ? 'mr-1' : 'ml-1';
@endphp

@if(isset($classes[$status]))
    <span {{ $attributes->merge(['class' => "$baseClass $sizeClass {$classes[$status]}"]) }}>
        @if($showIcon && $iconPosition === 'left')
            <span class="{{ $iconClass }} {{ $iconMarginClass }}" aria-hidden="true">
                {!! $icons[$status] !!}
            </span>
        @endif
        
        {{ $labels[$status] }}
        
        @if($showIcon && $iconPosition === 'right')
            <span class="{{ $iconClass }} {{ $iconMarginClass }}" aria-hidden="true">
                {!! $icons[$status] !!}
            </span>
        @endif
    </span>
@endif