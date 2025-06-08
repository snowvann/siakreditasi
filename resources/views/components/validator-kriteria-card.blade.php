<!-- resources/views/components/validator-kriteria-card.blade.php -->
@props([
    'criteria' => null,
    'onViewDetails' => route('validator.kriteria.show', ['id' => $criteria->id]),
])

<div class="rounded-lg border bg-card text-card-foreground shadow-sm overflow-hidden">
    <div class="flex items-center">
        <div class="flex-1">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $criteria->nama_kriteria }}</h3>
                        @if(isset($criteria->description))
                            <p class="text-sm text-muted-foreground mt-1">{{ $criteria->description }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-3 pt-0 flex justify-between items-center">
                {{ $slot ?? 'Klik untuk memvalidasi' }}
                <a href="{{ $onViewDetails }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-9 px-3">
                    Lihat Detail
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1 h-4 w-4">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>