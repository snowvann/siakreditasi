@props(['kriteria'])

<div class="rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 hover:scale-[1.02] group">
    <div class="flex items-center">
        <div class="flex-1">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:bg-gradient-to-r group-hover:from-[#95A0E8] group-hover:to-[#7548BE] group-hover:bg-clip-text group-hover:text-transparent transition-all duration-300">
                            Kriteria {{ $kriteria['id'] }}
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $kriteria['nama_kriteria'] }}</p>
                    </div>

                    @if(isset($kriteria['progressPercentage']))
                        <div class="text-right min-w-[80px]">
                            <div class="text-sm font-medium {{ $kriteria['progressPercentage'] >= 100 ? 'text-green-600' : ($kriteria['progressPercentage'] >= 50 ? 'text-blue-600' : 'text-gray-600') }}">
                                {{ $kriteria['progressPercentage'] }}%
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $kriteria['completedSubkriteria'] ?? 0 }}/{{ $kriteria['totalSubkriteria'] ?? 0 }}
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Progress Bar -->
                @if(isset($kriteria['progressPercentage']))
                    <div class="mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-[#95A0E8] to-[#7548BE] h-2 rounded-full transition-all duration-700 ease-out" 
                                 style="width: {{ $kriteria['progressPercentage'] }}%"></div>
                        </div>
                        <div class="flex items-center justify-between mt-2 text-xs">
                            <span class="text-gray-500">
                                @if($kriteria['progressPercentage'] == 100)
                                    ✅ Lengkap
                                @elseif($kriteria['progressPercentage'] >= 75)
                                    🎯 Hampir selesai
                                @elseif($kriteria['progressPercentage'] >= 50)
                                    ⚡ Separuh jalan
                                @elseif($kriteria['progressPercentage'] > 0)
                                    🚀 Dalam proses
                                @else
                                    📋 Belum dimulai
                                @endif
                            </span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="px-6 pb-4 flex justify-between items-center">
                <a href="{{ route('kriteria.show', $kriteria['id']) }}" 
                   class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-gradient-to-r from-[#95A0E8] to-[#7548BE] text-white hover:from-[#8a95e3] hover:to-[#6d42b8] focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 transition-all duration-200 h-9 px-4 shadow-sm hover:shadow-md">
                    Lihat Detail
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 h-4 w-4 transition-transform duration-200 group-hover:translate-x-1">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
                <div class="text-sm text-gray-500 font-medium">
                    {{ $slot ?? (isset($kriteria['totalSubkriteria']) ? $kriteria['totalSubkriteria'] . ' sub-kriteria' : '5 sub-kriteria') }}
                </div>
            </div>
        </div>
    </div>
</div>
