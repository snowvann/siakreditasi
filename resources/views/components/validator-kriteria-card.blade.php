@props(['kriteria'])

<div class="rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 hover:scale-[1.02] group">
    <div class="flex items-center">
        <div class="flex-1">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:bg-gradient-to-r group-hover:from-[#FF8F53] group-hover:to-[#6D2597] group-hover:bg-clip-text group-hover:text-transparent transition-all duration-300">
                            Kriteria {{ $kriteria['id'] }}
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $kriteria['nama_kriteria'] }}</p>
                    </div>
                </div>
            </div>

            <div class="p-3 pt-0 flex justify-between items-center">
                <a href="{{ route('validator.kriteria.show', $kriteria['id']) }}" 
                   class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-gradient-to-r from-[#EA8E32] to-[#4230BB] text-white hover:from-[#EA8E32] hover:to-[#4230BB] focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 transition-all duration-200 h-9 px-3 shadow-sm hover:shadow-md">
                    Lihat Detail
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1 h-4 w-4 transition-transform duration-200 group-hover:translate-x-1">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
                <div class="text-sm text-gray-500">
                    {{ $slot ?? '5 sub-kriteria' }}
                </div>
            </div>
        </div>
    </div>
</div>