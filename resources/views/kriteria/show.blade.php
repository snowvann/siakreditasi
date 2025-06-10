@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">

                            <!-- Header & Kembali -->
                <div class="flex items-start gap-3">
                    <a href="{{ route('dashboard') }}" 
                    class="flex-shrink-0 inline-flex items-center justify-center h-10 w-10 rounded-lg text-sm font-medium transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg text-gray-700 bg-white border border-gray-200 hover:bg-gradient-to-r hover:from-[#95A0E8] hover:to-[#7548BE] hover:text-white hover:border-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <path d="m12 19-7-7 7-7"></path>
                            <path d="M19 12H5"></path>
                        </svg>
                    </a>
                    <div class="flex-1 min-w-0">
                        <h1 class="text-2xl font-bold text-blue-900 break-words">{{ $kriteriaData['nama_kriteria'] }}</h1>
                        <p class="text-sm text-gray-500 break-words">{{ $kriteriaData['deskripsi'] }}</p>
                    </div>
                </div>

            <!-- Progress Bar Section -->
            <div class="rounded-lg border border-gray-200 shadow-sm bg-white p-6 transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-900">Progress Pengisian</h3>
                    <span class="text-sm font-medium text-gray-600">{{ $completedSubkriteria }}/{{ $totalSubkriteria }} Sub-kriteria</span>
                </div>
                
                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-3 mb-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#95A0E8] to-[#7548BE] h-3 rounded-full transition-all duration-700 ease-out shadow-sm" 
                         style="width: {{ $progressPercentage }}%"></div>
                </div>
                
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">
                        @if($progressPercentage == 100)
                            🎉 Semua sub-kriteria telah terisi
                        @elseif($progressPercentage >= 75)
                            Hampir selesai!
                        @elseif($progressPercentage >= 50)
                            Separuh perjalanan
                        @elseif($progressPercentage > 0)
                            Terus semangat!
                        @else
                            Mulai mengisi sub-kriteria
                        @endif
                    </span>
                    <span class="font-semibold text-lg {{ $progressPercentage >= 100 ? 'text-green-600' : 'text-blue-600' }}">
                        {{ $progressPercentage }}%
                    </span>
                </div>
            </div>

            <!-- Tab Container -->
            <div x-data="{ tab: 'subkriteria' }" x-cloak class="space-y-4">

                <!-- Tab Selector & Tombol PDF -->
                <div class="flex flex-wrap items-center justify-between border-b border-gray-200 pb-1">
                    <div class="flex gap-2 p-1 rounded-md bg-white">
                        <button @click="tab = 'subkriteria'" 
                                :class="tab === 'subkriteria' ? 'bg-gradient-to-r from-[#95A0E8] to-[#7548BE] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gradient-to-r hover:from-[#95A0E8] hover:to-[#7548BE] hover:text-white'" 
                                class="rounded-full px-3 py-1.5 text-sm font-medium transition-all duration-300 ease-in-out">
                            Sub-kriteria
                        </button>
                        <button @click="tab = 'validasi'" 
                                :class="tab === 'validasi' ? 'bg-gradient-to-r from-[#95A0E8] to-[#7548BE] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gradient-to-r hover:from-[#95A0E8] hover:to-[#7548BE] hover:text-white'" 
                                class="rounded-full px-3 py-1.5 text-sm font-medium transition-all duration-300 ease-in-out">
                            Validasi
                        </button>
                    </div>

                    <a href="{{ route('kriteria.unduh-pdf', $kriteriaId) }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 rounded-md px-4 py-1 text-sm font-semibold shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg bg-gradient-to-r from-yellow-400 to-orange-500 text-white hover:from-yellow-500 hover:to-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="7 10 12 15 17 10" />
                            <line x1="12" y1="15" x2="12" y2="3" />
                        </svg>
                        <span>Unduh PDF</span>
                    </a>
                </div>

                <!-- Subkriteria Content -->
                <div x-show="tab === 'subkriteria'" x-cloak class="grid gap-4">
                    @foreach($subKriteriaList as $subKriteria)
                        <div class="rounded-lg border border-gray-200 shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg bg-white">
                            <div class="flex items-center justify-between p-6">
                                <div class="flex items-center gap-3">
                                    <!-- Indicator Pengisian -->
                                    <div class="flex-shrink-0">
                                        @if($subKriteria->has_isian)
                                            <div class="w-3 h-3 bg-green-500 rounded-full shadow-sm animate-pulse"></div>
                                        @else
                                            <div class="w-3 h-3 bg-gray-300 rounded-full shadow-sm"></div>
                                        @endif
                                    </div>
                                    <div>
                                        <h2 class="font-medium text-gray-900">{{ $subKriteria['nama_subkriteria'] }}</h2>
                                        <p class="text-xs text-gray-500 mt-1">
                                            @if($subKriteria->has_isian)
                                                ✅ Sudah terisi
                                            @else
                                                ⏳ Belum terisi
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ url('kriteria/'.$kriteriaId.'/sub-kriteria/'.$subKriteria['id']) }}"
                                        class="inline-flex items-center gap-2 text-sm text-white bg-gradient-to-r from-[#95A0E8] to-[#7548BE] px-3 py-2 rounded-md transition-all duration-300 ease-in-out hover:opacity-90">
                                        <span>Detail</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="m9 18 6-6-6-6"></path>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Validasi Content -->
                <div x-show="tab === 'validasi'" x-cloak class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-blue-900">Riwayat Validasi</h3>
                    </div>

                    <div class="rounded-lg border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg bg-white">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-100 border-b border-gray-200">
                                    <tr>
                                        <th class="text-left p-4 font-medium text-sm text-gray-700">Validator</th>
                                        <th class="text-left p-4 font-medium text-sm text-gray-700">Tanggal</th>
                                        <th class="text-left p-4 font-medium text-sm text-gray-700">Status</th>
                                        <th class="text-left p-4 font-medium text-sm text-gray-700">Komentar</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($validasis as $item)
                                        <tr class="transition-all duration-300 ease-in-out hover:bg-gray-50">
                                            <td class="p-4 text-sm text-gray-900">{{ $item['user']->name ?? 'Unknown' }}</td>
                                            <td class="p-4 text-sm text-gray-600">{{ $item['waktu'] ? $item['waktu']->format('d M Y, H:i') : '-' }}</td>
                                            <td class="p-4">
                                                @php
                                                    $status = $item['status'];
                                                    $statusClasses = [
                                                        'valid' => 'text-green-700 bg-green-100',
                                                        'tidak valid' => 'text-yellow-700 bg-yellow-100',
                                                        'revisi' => 'text-red-700 bg-red-100',
                                                        'default' => 'text-gray-700 bg-gray-100'
                                                    ];
                                                    $statusDotClasses = [
                                                        'valid' => 'bg-green-500',
                                                        'tidak valid' => 'bg-yellow-500',
                                                        'revisi' => 'bg-red-500',
                                                        'default' => 'bg-gray-500'
                                                    ];
                                                    $statusClass = $statusClasses[$status] ?? $statusClasses['default'];
                                                    $statusDotClass = $statusDotClasses[$status] ?? $statusDotClasses['default'];
                                                @endphp
                                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium transition-all duration-300 ease-in-out {{ $statusClass }}">
                                                    <div class="w-1.5 h-1.5 rounded-full {{ $statusDotClass }}"></div>
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </td>
                                            <td class="p-4 text-sm text-gray-600">{{ $item['komentar'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if (count($validasis) === 0)
                                <div class="p-8 text-center text-sm text-gray-500">
                                    Belum ada riwayat validasi.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
</div>
@endsection