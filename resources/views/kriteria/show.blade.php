@extends('layouts.app')

@section('content')
<style>
:root {
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --secondary: #ec4899;
    --accent: #06b6d4;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --dark: #0f172a;
    --light: #f8fafc;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
}

.gradient-bg {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
}

.card-hover {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-hover:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
}

.glass-card {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.tab-active {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
}

.status-indicator {
    animation: pulse 2s infinite;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

.btn-modern {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-modern:hover::before {
    left: 100%;
}

.table-modern tbody tr {
    transition: all 0.2s ease;
}

.table-modern tbody tr:hover {
    background: var(--gray-50);
    transform: scale(1.01);
}

@media (max-width: 768px) {
    .mobile-responsive {
        padding: 1rem;
    }
    
    .mobile-stack {
        flex-direction: column;
        gap: 1rem;
    }
    
    .mobile-full {
        width: 100%;
    }
}
</style>

<div class="min-h-screen" style="background: linear-gradient(135deg, var(--gray-50) 0%, var(--light) 100%);">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-8 mobile-responsive">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Header Section with Modern Design -->
            <div class="fade-in-up">
                <div class="glass-card rounded-2xl p-6 md:p-8 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center justify-center h-12 w-12 rounded-xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 group">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" 
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                 class="text-gray-600 group-hover:text-primary transition-colors">
                                <path d="m12 19-7-7 7-7"></path>
                                <path d="M19 12H5"></path>
                            </svg>
                        </a>
                        <div class="flex-1">
                            <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                {{ $kriteriaData['nama_kriteria'] }}
                            </h1>
                            <p class="text-gray-600 mt-2 text-lg">{{ $kriteriaData['deskripsi'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Container with Modern Design -->
            <div x-data="{ tab: 'subkriteria' }" x-cloak class="fade-in-up">

                <!-- Tab Selector & PDF Button -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                    <div class="inline-flex bg-white rounded-2xl p-2 shadow-lg border border-gray-100">
                        <button @click="tab = 'subkriteria'" 
                                :class="tab === 'subkriteria' ? 'tab-active' : 'bg-transparent text-gray-600 hover:bg-gray-50'" 
                                class="rounded-xl px-6 py-3 text-sm font-semibold transition-all duration-300 min-w-[120px]">
                            Sub-kriteria
                        </button>
                        <button @click="tab = 'validasi'" 
                                :class="tab === 'validasi' ? 'tab-active' : 'bg-transparent text-gray-600 hover:bg-gray-50'" 
                                class="rounded-xl px-6 py-3 text-sm font-semibold transition-all duration-300 min-w-[120px]">
                            Validasi
                        </button>
                    </div>

                    <a href="{{ route('kriteria.unduh-pdf', $kriteriaId) }}" target="_blank" rel="noopener noreferrer"
                       class="btn-modern inline-flex items-center gap-3 rounded-2xl px-6 py-3 text-sm font-semibold shadow-lg hover:shadow-xl transition-all duration-300 mobile-full lg:w-auto"
                       style="background: linear-gradient(135deg, var(--warning), #d97706); color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Unduh PDF</span>
                    </a>
                </div>

                <!-- Subkriteria Content -->
                <div x-show="tab === 'subkriteria'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="grid gap-6 md:gap-8">
                    @foreach($subKriteriaList as $index => $subKriteria)
                        <div class="card-hover rounded-2xl bg-white shadow-lg hover:shadow-xl border border-gray-100 overflow-hidden"
                             style="animation-delay: {{ $index * 0.1 }}s;">
                            <div class="p-6 md:p-8">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex-1">
                                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $subKriteria['nama_subkriteria'] }}</h2>
                                        <div class="h-1 w-16 bg-gradient-to-r from-primary to-accent rounded-full"></div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <a href="{{ url('kriteria/'.$kriteriaId.'/sub-kriteria/'.$subKriteria['id']) }}"
   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-primary to-primary-dark text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group text-sm font-medium">
    <span>Buka Detail</span>
    <svg xmlns="http://www.w3.org/2000/svg"
     class="h-4 w-4 group-hover:translate-x-1 transition-transform"
     fill="none"
     viewBox="0 0 24 24"
     stroke="#fff"
     stroke-width="2"
     stroke-linecap="round"
     stroke-linejoin="round">
    <path d="M9 5l7 7-7 7" />
</svg>

</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Validasi Content -->
                <div x-show="tab === 'validasi'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="space-y-6">
                     
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                            <div class="h-8 w-1 bg-gradient-to-b from-primary to-accent rounded-full"></div>
                            Riwayat Validasi
                        </h3>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full table-modern">
                                <thead style="background: linear-gradient(135deg, var(--gray-50), var(--gray-100));">
                                    <tr>
                                        <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">Validator</th>
                                        <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">Tanggal</th>
                                        <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">Status</th>
                                        <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">Komentar</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach ($validasis as $item)
                                        <tr class="hover:bg-gray-50 transition-all duration-200">
                                            <td class="p-6">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-10 w-10 bg-gradient-to-r from-primary to-accent rounded-full flex items-center justify-center text-white font-semibold">
                                                        {{ substr($item['user']->name ?? 'U', 0, 1) }}
                                                    </div>
                                                    <span class="font-medium text-gray-800">{{ $item['user']->name ?? 'Unknown' }}</span>
                                                </div>
                                            </td>
                                            <td class="p-6 text-gray-600 font-medium">
                                                {{ $item['waktu'] ? $item['waktu']->format('d M Y, H:i') : '-' }}
                                            </td>
                                            <td class="p-6">
                                                @php
                                                    $status = $item['status'];
                                                    $statusConfig = [
                                                        'valid' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'dot' => 'bg-green-500'],
                                                        'tidak valid' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500'],
                                                        'revisi' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'dot' => 'bg-red-500'],
                                                        'default' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'dot' => 'bg-gray-500']
                                                    ];
                                                    $config = $statusConfig[$status] ?? $statusConfig['default'];
                                                @endphp
                                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
                                                    <div class="w-2 h-2 {{ $config['dot'] }} rounded-full animate-pulse"></div>
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </td>
                                            <td class="p-6 text-gray-600 max-w-xs">
                                                <div class="truncate" title="{{ $item['komentar'] }}">
                                                    {{ $item['komentar'] ?: 'Tidak ada komentar' }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if (count($validasis) === 0)
                                <div class="p-12 text-center">
                                    <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-lg font-medium">Belum ada riwayat validasi</p>
                                    <p class="text-gray-400 text-sm mt-1">Data validasi akan muncul di sini setelah ada aktivitas validasi</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
</div>

<script>
// Add some interactive enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Add loading states for buttons
    document.querySelectorAll('.btn-modern').forEach(button => {
        button.addEventListener('click', function() {
            if (!this.hasAttribute('target') || this.getAttribute('target') !== '_blank') {
                this.classList.add('opacity-75');
                this.style.pointerEvents = 'none';
            }
        });
    });
});
</script>
@endsection