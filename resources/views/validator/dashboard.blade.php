@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.validator-header')

    <main class="container mx-auto px-4 py-6 animate-fade-in">
        <div class="grid gap-6">
            <!-- Header dan Search -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-slide-down">
            <h1 class="text-3xl font-bold flex-shrink-0 bg-gradient-to-b from-[#EA8E32] to-[#4230BB] bg-clip-text text-transparent transition-all duration-300 cursor-default">
                Kriteria Validator
            </h1>
            </div>

            <!-- Progress Card -->
            <div class="bg-gradient-to-b from-[#d3394c] to-[#7C4585] rounded-lg shadow-sm animate-slide-up transition-all duration-300 hover:shadow-md hover:scale-[1.02] text-white">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-white">Progress Akreditasi</h2>
                <p class="text-sm text-white/80">Status keseluruhan kriteria akreditasi</p>
            </div>
            <div class="p-6 pt-0">
                <div class="space-y-2 text-sm">
                    <p class="text-white/80">Tinjau semua kriteria di bawah ini.</p>
                </div>
            </div>
        </div>
        
            <!-- Daftar Semua Kriteria -->
            @php
                $allKriteria = [
                    ['id' => 1, 'nama_kriteria' => 'Visi, Misi, Tujuan dan Strategi'],
                    ['id' => 2, 'nama_kriteria' => 'Tata Pamong, Tata Kelola dan Kerjasama'],
                    ['id' => 3, 'nama_kriteria' => 'Mahasiswa'],
                    ['id' => 4, 'nama_kriteria' => 'Sumber Daya Manusia'],
                    ['id' => 5, 'nama_kriteria' => 'Keuangan, Sarana dan Prasarana'],
                    ['id' => 6, 'nama_kriteria' => 'Pendidikan'],
                    ['id' => 7, 'nama_kriteria' => 'Penelitian'],
                    ['id' => 8, 'nama_kriteria' => 'Pengabdian kepada Masyarakat'],
                    ['id' => 9, 'nama_kriteria' => 'Luaran dan Capaian Tridharma'],
                ];

                $query = strtolower(request('q'));
                $filteredKriteria = array_filter($allKriteria, function($kriteria) use ($query) {
                    return $query === null || $query === ''
                        || str_contains(strtolower($kriteria['nama_kriteria']), $query);
                });
            @endphp

            <div class="grid gap-4 mt-6 animate-fade-in-up">
                @forelse($filteredKriteria as $index => $kriteria)
                    <div class="animate-slide-in-left" style="animation-delay: {{ $index * 0.1 }}s;">
                        <x-validator-kriteria-card :kriteria="$kriteria" />
                    </div>
                @empty
                    <div class="animate-fade-in text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-gray-400 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-1.18-5.5-3m11.36 0A7.96 7.96 0 0012 15m0 0v6m0-6V9a3 3 0 00-3-3H9m1.5-2-3 3 3 3" />
                        </svg>
                        <p class="text-gray-500">Tidak ada kriteria yang cocok dengan pencarian.</p>
                        <p class="text-sm mt-2 text-gray-400">Coba ubah kata kunci pencarian Anda.</p>
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