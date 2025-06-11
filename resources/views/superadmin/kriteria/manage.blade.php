@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    @include('components.dashboard-header')
    
    <!-- Enhanced Header Section -->
    <main class="container mx-auto px-4 py-8">
        <div class="relative z-10">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-3xl opacity-10 blur-xl"></div>
            <div class="relative bg-white/80 backdrop-blur-sm rounded-3xl p-8 pb-25 shadow-xl border border-white/20 min-h-[170px]"> 
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="space-y-4">
                        <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                            Manajemen Kriteria dan Sub-Kriteria
                        </h1>
                        <p class="text-gray-600 text-lg mt-5">Kelola kriteria penilaian dan sub-kriteria secara efisien</p>
                    </div>
                    
                    {{-- <!-- Enhanced Search -->
                    <div class="w-full lg:w-96">
                        <form method="GET" action="{{ route('criteria.manage') }}" class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200/50">
                                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                                    </svg>
                                </div>
                                <input
                                    type="search"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari kriteria atau sub-kriteria..."
                                    class="w-full pl-12 pr-6 py-4 bg-transparent border-0 rounded-2xl focus:outline-none focus:ring-0 text-gray-700 placeholder-gray-400"
                                />
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Header Actions -->
        <div class="container mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center gap-4">
            <!-- Add Criteria Button -->
            <button onclick="openAddCriteriaModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Tambah Kriteria
            </button>
            
            <!-- Add Sub-Criteria Button (Visible when a criteria is selected) -->
            <button id="addSubCriteriaBtn" onclick="openAddSubCriteriaModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center hidden">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Tambah Sub-Kriteria
            </button>
        </div>

        <!-- Criteria Management Cards -->
        <div class="container mx-auto px-6 space-y-4">
            @foreach($kriteriaList as $kriteria)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <!-- Criteria Header -->
                <div class="criteria-header bg-gray-50 border-b border-gray-200 p-4 cursor-pointer hover:bg-gray-100 transition-colors duration-200" 
                     onclick="toggleCriteria({{ $kriteria->id }})">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- Expand/Collapse Icon -->
                            <div class="expand-icon transition-transform duration-200" id="icon-{{ $kriteria->id }}">
                                <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500"></i>
                            </div>
                            
                            <!-- Criteria Icon and Info -->
                            <div class="flex items-center space-x-3">
                                <div class="bg-blue-100 p-2 rounded-lg">
                                    <i data-lucide="file-text" class="w-5 h-5 text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Kriteria {{ $loop->iteration }}: {{ $kriteria->nama }}
                                    </h3>
                                    <p class="text-sm text-gray-600">{{ $kriteria->deskripsi }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $kriteria->subkriteria->count() }} sub-kriteria</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Percentage and Actions -->
                        <div class="flex items-center space-x-4">
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                                {{ $kriteria->persentase }}%
                            </span>
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center space-x-2">
                                <button onclick="event.stopPropagation(); openAddSubCriteriaModal({{ $kriteria->id }})" 
                                        class="text-green-600 hover:text-green-800 p-1 rounded hover:bg-green-50" 
                                        title="Tambah Sub-Kriteria">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                    <span class="text-xs ml-1">Sub-Kriteria</span>
                                </button>
                                
                                <button onclick="event.stopPropagation(); openEditCriteriaModal({{ $kriteria->id }})" 
                                        class="text-blue-600 hover:text-blue-800 p-1 rounded hover:bg-blue-50" 
                                        title="Edit Kriteria">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </button>
                                
                                <button onclick="event.stopPropagation(); deleteCriteria({{ $kriteria->id }})" 
                                        class="text-red-600 hover:text-red-800 p-1 rounded hover:bg-red-50" 
                                        title="Hapus Kriteria">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sub-Criteria List (Collapsible) -->
                <div class="criteria-content" id="content-{{ $kriteria->id }}" style="display: none;">
                    @if($kriteria->subkriteria->count() > 0)
                        @foreach($kriteria->subkriteria as $subkriteria)
                        <div class="subcriteria-item border-l-4 border-blue-200 bg-blue-50/30 p-4 border-b border-gray-100 last:border-b-0 hover:bg-blue-50/50 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4 ml-8">
                                    <!-- Sub-criteria Icon -->
                                    <div class="bg-gray-100 p-1.5 rounded">
                                        <i data-lucide="list" class="w-4 h-4 text-gray-600"></i>
                                    </div>
                                    
                                    <!-- Sub-criteria Info -->
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $subkriteria->nama_subkriteria }}</h4>
                                        <p class="text-sm text-gray-600">{{ $subkriteria->deskripsi }}</p>
                                    </div>
                                </div>
                                
                                <!-- Sub-criteria Percentage and Actions -->
                                <div class="flex items-center space-x-3">
                                    <span class="bg-gray-100 text-gray-700 text-sm font-medium px-2 py-1 rounded">
                                        {{ $subkriteria->persentase }}%
                                    </span>
                                    
                                    <!-- Sub-criteria Actions -->
                                    <div class="flex items-center space-x-1">
                                        <button onclick="openEditSubCriteriaModal({{ $subkriteria->id }})" 
                                                class="text-blue-600 hover:text-blue-800 p-1 rounded hover:bg-blue-100" 
                                                title="Edit Sub-Kriteria">
                                            <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                        </button>
                                        
                                        <button onclick="deleteSubCriteria({{ $subkriteria->id }})" 
                                                class="text-red-600 hover:text-red-800 p-1 rounded hover:bg-red-100" 
                                                title="Hapus Sub-Kriteria">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="p-8 text-center text-gray-500">
                            <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                            <p>Belum ada sub-kriteria</p>
                            <button onclick="openAddSubCriteriaModal({{ $kriteria->id }})" 
                                    class="mt-2 text-blue-600 hover:text-blue-800 text-sm">
                                Tambah sub-kriteria pertama
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
            
            @if($kriteriaList->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <i data-lucide="folder-open" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kriteria</h3>
                <p class="text-gray-600 mb-4">Mulai dengan menambahkan kriteria penilaian pertama</p>
                <button onclick="openAddCriteriaModal()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Tambah Kriteria
                </button>
            </div>
            @endif
        </div>
    </main>
</div>

<!-- Add Criteria Modal -->
<div id="addCriteriaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Tambah Kriteria Baru</h3>
                <button onclick="closeAddCriteriaModal()" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <form id="addCriteriaForm" onsubmit="submitAddCriteria(event)">
                @csrf
                <div class="mb-4">
                    <label for="criteriaName" class="block text-sm font-medium text-gray-700 mb-2">Nama Kriteria</label>
                    <input type="text" id="criteriaName" name="nama" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan nama kriteria">
                </div>
                
                <div class="mb-4">
                    <label for="criteriaDescription" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="criteriaDescription" name="deskripsi" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Masukkan deskripsi kriteria"></textarea>
                </div>
                
                <div class="mb-6">
                    <label for="criteriaPercentage" class="block text-sm font-medium text-gray-700 mb-2">Persentase (%)</label>
                    <input type="number" id="criteriaPercentage" name="persentase" min="0" max="100" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="0-100">
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAddCriteriaModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Criteria Modal -->
<div id="editCriteriaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Edit Kriteria</h3>
                <button onclick="closeEditCriteriaModal()" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <form id="editCriteriaForm" onsubmit="submitEditCriteria(event)">
                @csrf
                @method('PUT')
                <input type="hidden" id="editCriteriaId" name="id">
                
                <div class="mb-4">
                    <label for="editCriteriaName" class="block text-sm font-medium text-gray-700 mb-2">Nama Kriteria</label>
                    <input type="text" id="editCriteriaName" name="nama" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="mb-4">
                    <label for="editCriteriaDescription" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="editCriteriaDescription" name="deskripsi" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <div class="mb-6">
                    <label for="editCriteriaPercentage" class="block text-sm font-medium text-gray-700 mb-2">Persentase (%)</label>
                    <input type="number" id="editCriteriaPercentage" name="persentase" min="0" max="100" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeEditCriteriaModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Sub-Criteria Modal -->
<div id="addSubCriteriaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Tambah Sub-Kriteria</h3>
                <button onclick="closeAddSubCriteriaModal()" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <form id="addSubCriteriaForm" onsubmit="submitAddSubCriteria(event)">
                @csrf
                <input type="hidden" id="parentCriteriaId" name="kriteria_id">
                
                <div class="mb-4">
                    <label for="subCriteriaName" class="block text-sm font-medium text-gray-700 mb-2">Nama Sub-Kriteria</label>
                    <input type="text" id="subCriteriaName" name="nama_subkriteria" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan nama sub-kriteria">
                </div>
                
                <div class="mb-4">
                    <label for="subCriteriaDescription" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="subCriteriaDescription" name="deskripsi" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Masukkan deskripsi sub-kriteria"></textarea>
                </div>
                
                <div class="mb-6">
                    <label for="subCriteriaPercentage" class="block text-sm font-medium text-gray-700 mb-2">Persentase (%)</label>
                    <input type="number" id="subCriteriaPercentage" name="persentase" min="0" max="100" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="0-100">
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAddSubCriteriaModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Sub-Criteria Modal -->
<div id="editSubCriteriaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Edit Sub-Kriteria</h3>
                <button onclick="closeEditSubCriteriaModal()" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <form id="editSubCriteriaForm" onsubmit="submitEditSubCriteria(event)">
                @csrf
                @method('PUT')
                <input type="hidden" id="editSubCriteriaId" name="id">
                
                <div class="mb-4">
                    <label for="editSubCriteriaName" class="block text-sm font-medium text-gray-700 mb-2">Nama Sub-Kriteria</label>
                    <input type="text" id="editSubCriteriaName" name="nama_subkriteria" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="mb-4">
                    <label for="editSubCriteriaDescription" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="editSubCriteriaDescription" name="deskripsi" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <div class="mb-6">
                    <label for="editSubCriteriaPercentage" class="block text-sm font-medium text-gray-700 mb-2">Persentase (%)</label>
                    <input type="number" id="editSubCriteriaPercentage" name="persentase" min="0" max="100" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeEditSubCriteriaModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-3">
        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
        <span class="text-gray-700">Memproses...</span>
    </div>
</div>

<!-- Tambahkan di head atau sebelum penutup body -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    // Kode JavaScript Anda
    lucide.createIcons(); // Inisialisasi icons
</script>

<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Show/Hide loading overlay
    function showLoading() {
        document.getElementById('loadingOverlay').classList.remove('hidden');
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').classList.add('hidden');
    }

    // Toggle criteria visibility
    function toggleCriteria(criteriaId) {
        const content = document.getElementById(`content-${criteriaId}`);
        const icon = document.getElementById(`icon-${criteriaId}`);
        
        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.style.display = 'none';
            icon.style.transform = 'rotate(0deg)';
        }
    }

    // Add this to your JavaScript section
    let selectedCriteriaId = null;

    function setSelectedCriteria(id) {
        selectedCriteriaId = id;
        const addSubBtn = document.getElementById('addSubCriteriaBtn');
        if (id) {
            addSubBtn.classList.remove('hidden');
            addSubBtn.onclick = function() { openAddSubCriteriaModal(id) };
        } else {
            addSubBtn.classList.add('hidden');
        }
    }

    function openAddSubCriteriaModal(id = null) {
        if (!id && !selectedCriteriaId) return;
        const criteriaId = id || selectedCriteriaId;
        document.getElementById('parentCriteriaId').value = criteriaId;
        document.getElementById('addSubCriteriaModal').classList.remove('hidden');
        document.getElementById('addSubCriteriaForm').reset();
        lucide.createIcons();
    }

    // Modify your toggleCriteria function to handle selection
    function toggleCriteria(criteriaId) {
        const content = document.getElementById(`content-${criteriaId}`);
        const icon = document.getElementById(`icon-${criteriaId}`);
        
        if (content.style.display === 'none' || content.style.display === '') {
            // Close all other criteria first
            document.querySelectorAll('.criteria-content').forEach(el => {
                if (el.id !== `content-${criteriaId}`) {
                    el.style.display = 'none';
                    const otherId = el.id.split('-')[1];
                    document.getElementById(`icon-${otherId}`).style.transform = 'rotate(0deg)';
                }
            });
            
            content.style.display = 'block';
            icon.style.transform = 'rotate(180deg)';
            setSelectedCriteria(criteriaId);
        } else {
            content.style.display = 'none';
            icon.style.transform = 'rotate(0deg)';
            setSelectedCriteria(null);
        }
    }
    // ======================
    // ADD CRITERIA FUNCTIONS
    // ======================
    function openAddCriteriaModal() {
        document.getElementById('addCriteriaModal').classList.remove('hidden');
        // Reset form
        document.getElementById('addCriteriaForm').reset();
        lucide.createIcons();
    }

    function closeAddCriteriaModal() {
        document.getElementById('addCriteriaModal').classList.add('hidden');
    }

    function submitAddCriteria(event) {
        event.preventDefault();
        showLoading();
        
        const formData = new FormData(event.target);
        
        fetch('/criteria/store', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                closeAddCriteriaModal();
                showNotification('Kriteria berhasil ditambahkan!', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showNotification(data.message || 'Gagal menambahkan kriteria', 'error');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat menambahkan kriteria', 'error');
        });
    }

    // ======================
    // EDIT CRITERIA FUNCTIONS
    // ======================
    function openEditCriteriaModal(criteriaId) {
        showLoading();
        
        fetch(`/criteria/${criteriaId}/edit`)
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                document.getElementById('editCriteriaId').value = data.data.id;
                document.getElementById('editCriteriaName').value = data.data.nama;
                document.getElementById('editCriteriaDescription').value = data.data.deskripsi;
                document.getElementById('editCriteriaPercentage').value = data.data.persentase;
                
                document.getElementById('editCriteriaModal').classList.remove('hidden');
                lucide.createIcons();
            } else {
                showNotification(data.message || 'Gagal memuat data kriteria', 'error');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat memuat data kriteria', 'error');
        });
    }

    function closeEditCriteriaModal() {
        document.getElementById('editCriteriaModal').classList.add('hidden');
    }

    function submitEditCriteria(event) {
        event.preventDefault();
        showLoading();
        
        const formData = new FormData(event.target);
        const criteriaId = document.getElementById('editCriteriaId').value;
        
        fetch(`/criteria/${criteriaId}/update`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                closeEditCriteriaModal();
                showNotification('Kriteria berhasil diupdate!', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showNotification(data.message || 'Gagal mengupdate kriteria', 'error');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat mengupdate kriteria', 'error');
        });
    }

    // ======================
    // ADD SUB-CRITERIA FUNCTIONS
    // ======================
    function openAddSubCriteriaModal(criteriaId) {
        document.getElementById('parentCriteriaId').value = criteriaId;
        document.getElementById('addSubCriteriaModal').classList.remove('hidden');
        // Reset form
        document.getElementById('addSubCriteriaForm').reset();
        document.getElementById('parentCriteriaId').value = criteriaId; // Set again after reset
        lucide.createIcons();
    }

    function closeAddSubCriteriaModal() {
        document.getElementById('addSubCriteriaModal').classList.add('hidden');
    }

    function submitAddSubCriteria(event) {
        event.preventDefault();
        showLoading();
        
        const formData = new FormData(event.target);
        
        fetch('/subcriteria/store', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                closeAddSubCriteriaModal();
                showNotification('Sub-kriteria berhasil ditambahkan!', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showNotification(data.message || 'Gagal menambahkan sub-kriteria', 'error');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat menambahkan sub-kriteria', 'error');
        });
    }

    // ======================
    // EDIT SUB-CRITERIA FUNCTIONS
    // ======================
    function openEditSubCriteriaModal(subCriteriaId) {
        showLoading();
        
        fetch(`/subcriteria/${subCriteriaId}/edit`)
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                document.getElementById('editSubCriteriaId').value = data.data.id;
                document.getElementById('editSubCriteriaName').value = data.data.nama_subkriteria;
                document.getElementById('editSubCriteriaDescription').value = data.data.deskripsi;
                document.getElementById('editSubCriteriaPercentage').value = data.data.persentase;
                
                document.getElementById('editSubCriteriaModal').classList.remove('hidden');
                lucide.createIcons();
            } else {
                showNotification(data.message || 'Gagal memuat data sub-kriteria', 'error');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat memuat data sub-kriteria', 'error');
        });
    }

    function closeEditSubCriteriaModal() {
        document.getElementById('editSubCriteriaModal').classList.add('hidden');
    }

    function submitEditSubCriteria(event) {
        event.preventDefault();
        showLoading();
        
        const formData = new FormData(event.target);
        const subCriteriaId = document.getElementById('editSubCriteriaId').value;
        
        fetch(`/subcriteria/${subCriteriaId}/update`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                closeEditSubCriteriaModal();
                showNotification('Sub-kriteria berhasil diupdate!', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showNotification(data.message || 'Gagal mengupdate sub-kriteria', 'error');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat mengupdate sub-kriteria', 'error');
        });
    }

    // ======================
    // DELETE FUNCTIONS
    // ======================
    function deleteCriteria(criteriaId) {
        if (confirm('Yakin ingin menghapus kriteria ini? Semua sub-kriteria juga akan terhapus.')) {
            showLoading();
            
            fetch(`/criteria/${criteriaId}/delete`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    showNotification('Kriteria berhasil dihapus!', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showNotification(data.message || 'Gagal menghapus kriteria', 'error');
                }
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menghapus kriteria', 'error');
            });
        }
    }

    function deleteSubCriteria(subCriteriaId) {
        if (confirm('Yakin ingin menghapus sub-kriteria ini?')) {
            showLoading();
            
            fetch(`/subcriteria/${subCriteriaId}/delete`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    showNotification('Sub-kriteria berhasil dihapus!', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showNotification(data.message || 'Gagal menghapus sub-kriteria', 'error');
                }
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menghapus sub-kriteria', 'error');
            });
        }
    }

    // ======================
    // NOTIFICATION FUNCTION
    // ======================
    function showNotification(message, type = 'success') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transition-all duration-300 transform translate-x-full`;
        
        if (type === 'success') {
            notification.classList.add('bg-green-500', 'text-white');
            notification.innerHTML = `
                <div class="flex items-center">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
        } else {
            notification.classList.add('bg-red-500', 'text-white');
            notification.innerHTML = `
                <div class="flex items-center">
                    <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
        }
        
        document.body.appendChild(notification);
        lucide.createIcons();
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Animate out after 3 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Auto-expand first criteria (optional)
    document.addEventListener('DOMContentLoaded', function() {
        const firstCriteria = document.querySelector('[id^="content-"]');
        if (firstCriteria) {
            const criteriaId = firstCriteria.id.split('-')[1];
            toggleCriteria(criteriaId);
        }
        
        // Initialize icons for any dynamically loaded content
        lucide.createIcons();
    });

    
</script>

<style>
    .expand-icon {
        transition: transform 0.2s ease;
    }
    
    .criteria-header:hover {
        background-color: #f9fafb;
    }
    
    .subcriteria-item {
        transition: background-color 0.2s ease;
    }
    
    .subcriteria-item:hover {
        background-color: rgba(59, 130, 246, 0.05);
    }
    
    /* New styles for buttons */
    .action-btn {
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
</style>

@endsection