@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center mb-4">
                    <a href="{{ route('validator.dashboard') }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-[#7548BE] transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Status Pengisian Kriteria</h1>
            </div>

            <!-- Alert Card -->
            <div class="bg-white rounded-lg shadow-sm border border-red-200 mb-6">
                <div class="p-6">
                    <!-- Icon dan Status -->
                    <div class="flex items-center justify-center mb-6">
                        <div class="flex items-center justify-center w-20 h-20 bg-red-100 rounded-full">
                            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Judul -->
                    <div class="text-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            Validasi Belum Dapat Dilakukan
                        </h2>
                        <p class="text-gray-600">
                            Semua kriteria harus diselesaikan terlebih dahulu oleh anggota sebelum proses validasi dapat dimulai.
                        </p>
                    </div>

                    <!-- Summary Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="text-3xl font-bold text-green-600">{{ $completedKriteria }}</div>
                            <div class="text-sm text-green-700">Kriteria Selesai</div>
                        </div>
                        <div class="text-center p-4 bg-red-50 rounded-lg border border-red-200">
                            <div class="text-3xl font-bold text-red-600">{{ $totalKriteria - $completedKriteria }}</div>
                            <div class="text-sm text-red-700">Kriteria Belum Selesai</div>
                        </div>
                        <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="text-3xl font-bold text-blue-600">{{ $totalKriteria }}</div>
                            <div class="text-sm text-blue-700">Total Kriteria</div>
                        </div>
                    </div>

                    
                </div>
            </div>

            <!-- Detail Kriteria -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Status Kriteria</h3>
                    
                    <div class="space-y-4">
                        @foreach($allKriteria as $kriteria)
                        <div class="border rounded-lg p-4 {{ $kriteria['isCompleted'] ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900">{{ $kriteria['nama_kriteria'] }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $kriteria['completedSubkriteria'] }} dari {{ $kriteria['totalSubkriteria'] }} subkriteria terisi
                                    </p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <!-- Status Badge -->
                                    @if($kriteria['isCompleted'])
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Belum Selesai
                                        </span>
                                    @endif
                                    
                                    <!-- Progress Percentage -->
                                    <span class="text-sm font-semibold {{ $kriteria['isCompleted'] ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $kriteria['progress'] }}%
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Progress Bar per Kriteria -->
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full transition-all duration-500 {{ $kriteria['isCompleted'] ? 'bg-green-500' : 'bg-red-400' }}" 
                                     style="width: {{ $kriteria['progress'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Info Tambahan -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-medium mb-2">Ketentuan Validasi:</p>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Semua kriteria harus mencapai 100%</strong> sebelum validasi dapat dimulai</li>
                                <li>Setiap subkriteria harus memiliki nilai yang terisi lengkap</li>
                                <li>Tidak ada pengecualian untuk kriteria yang belum selesai</li>
                                <li>Halaman ini akan terupdate otomatis saat anggota melengkapi pengisian</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Langkah Selanjutnya</h3>
                <div class="space-y-3 text-gray-600 mb-6">
                    <div class="flex items-start">
                        <span class="flex items-center justify-center w-6 h-6 bg-[#7548BE] text-white text-xs font-bold rounded-full mr-3 mt-0.5 flex-shrink-0">1</span>
                        <p>Hubungi anggota untuk melengkapi pengisian kriteria yang masih belum selesai</p>
                    </div>
                    <div class="flex items-start">
                        <span class="flex items-center justify-center w-6 h-6 bg-[#7548BE] text-white text-xs font-bold rounded-full mr-3 mt-0.5 flex-shrink-0">2</span>
                        <p>Pantau progress melalui dashboard atau refresh halaman ini secara berkala</p>
                    </div>
                    <div class="flex items-start">
                        <span class="flex items-center justify-center w-6 h-6 bg-[#7548BE] text-white text-xs font-bold rounded-full mr-3 mt-0.5 flex-shrink-0">3</span>
                        <p>Setelah semua kriteria 100%, validasi akan tersedia untuk semua kriteria</p>
                    </div>
                </div>

                <div class="flex justify-center">
                    
                </div>
            </div>
        </div>
    </main>
</div>
@endsection