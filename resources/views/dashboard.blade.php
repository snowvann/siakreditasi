@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6 animate-fade-in">
        <div class="grid gap-6">
            <!-- Header dan Search -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-slide-down">
                <h1 class="text-3xl font-bold flex-shrink-0 bg-gradient-to-r from-[#95A0E8] to-[#7548BE] bg-clip-text text-transparent transition-all duration-300 cursor-default">
                    Dashboard Akreditasi 
                </h1>
            </div>

                       <!-- Progress Card Global -->
<div class="bg-gradient-to-r from-[#7548BE] to-[#95A0E8] rounded-lg shadow-sm animate-slide-up transition-all duration-300 hover:shadow-md hover:scale-[1.02] text-white">
    <div class="p-6">
        <h2 class="text-lg font-semibold text-white">Progress Akreditasi</h2>
        <p class="text-sm text-white/80 mb-4">Status keseluruhan kriteria akreditasi</p>

        <!-- Progress & Total Side by Side -->
        <div class="flex flex-col sm:flex-row sm:items-center mb-4">
            <!-- Progress Bar Global -->
            <div class="flex-1">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-white/90">Progress Keseluruhan</span>
                    <span class="text-sm font-medium text-white">{{ $averageProgress }}%</span>
                </div>

                <div class="w-full bg-white/20 rounded-full h-3 mb-2 overflow-hidden">
                    <div class="bg-white h-3 rounded-full transition-all duration-700 ease-out shadow-sm" 
                         style="width: {{ $averageProgress }}%"></div>
                </div>

                <div class="text-sm text-white/80">
                    @if($averageProgress == 100)
                        🎉 Semua kriteria telah lengkap!
                    @elseif($averageProgress >= 75)
                        Hampir selesai semua!
                    @elseif($averageProgress >= 50)
                        Setengah perjalanan tercapai
                    @elseif($averageProgress > 0)
                        Terus semangat mengisi!
                    @else
                        Mulai mengisi kriteria akreditasi
                    @endif
                </div>
            </div>

            <!-- Garis Pemisah Vertikal -->
            <div class="hidden sm:flex sm:items-center sm:mx-6">
                <div class="w-px h-16 bg-white/30"></div>
            </div>

            <!-- Garis Pemisah Horizontal (Mobile) -->
            <div class="sm:hidden my-4">
                <div class="h-px w-full bg-white/30"></div>
            </div>

            <!-- Total Kriteria -->
            <div class="text-center sm:w-32">
                <div class="text-3xl font-bold text-white">{{ count($kriteria) }}</div>
                <div class="text-sm text-white/80">Total Kriteria</div>
            </div>
        </div>
    </div>
</div>


            <!-- Daftar Semua Kriteria -->
            <div class="grid gap-4 mt-6 animate-fade-in-up">
                @forelse($kriteria as $index => $kriteriaItem)
                    <div class="animate-slide-in-left" style="animation-delay: {{ $index * 0.1 }}s;">
                        <x-kriteria-card :kriteria="$kriteriaItem">
                            <!-- Progress info untuk slot -->
                            <div class="text-sm text-gray-500">
                                {{ $kriteriaItem['completedSubkriteria'] }}/{{ $kriteriaItem['totalSubkriteria'] }} sub-kriteria
                            </div>
                        </x-kriteria-card>
                    </div>
                @empty
                    <div class="animate-fade-in text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-gray-400 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-1.18-5.5-3m11.36 0A7.96 7.96 0 0012 15m0 0v6m0-6V9a3 3 0 00-3-3H9m1.5-2-3 3 3 3" />
                        </svg>
                        <p class="text-gray-500">Tidak ada kriteria yang ditemukan.</p>
                        <p class="text-sm mt-2 text-gray-400">Silakan hubungi administrator untuk menambahkan kriteria.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slide-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-in-left {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animate-slide-down {
    animation: slide-down 0.5s ease-out;
}

.animate-slide-up {
    animation: slide-up 0.6s ease-out 0.2s both;
}

.animate-fade-in-up {
    animation: fade-in-up 0.7s ease-out 0.3s both;
}

.animate-slide-in-left {
    animation: slide-in-left 0.5s ease-out both;
}
</style>
@endsection