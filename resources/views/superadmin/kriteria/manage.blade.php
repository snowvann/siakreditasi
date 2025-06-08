@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    @include('components.dashboard-header')

    <!-- Enhanced Header Section -->
    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-3xl opacity-10 blur-xl"></div>
        <div class="relative bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-white/20">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-2">
                    <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                        Manajemen Kriteria
                    </h1>
                    <p class="text-gray-600 text-lg">Kelola kriteria dan sub-kriteria akreditasi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Actions -->
    <div class="container mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <button onclick="openAddCriteriaModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Tambah Kriteria
        </button>
    </div>

    <!-- Search -->
    <div class="container mx-auto px-6">
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6">
                <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                    <input 
                        type="text" 
                        placeholder="Cari kriteria atau sub-kriteria..." 
                        class="w-full pl-10 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="searchInput"
                        oninput="filterCriteria()"
                    >
                </div>
            </div>
        </div>
    </div>

    <!-- Criteria List -->
    <div class="container mx-auto px-6 space-y-4" id="criteriaList">
        <!-- Criteria will be loaded dynamically -->
    </div>
</div>

<!-- Add Criteria Modal -->
<div id="addCriteriaModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Kriteria Baru</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Masukkan informasi kriteria baru yang akan ditambahkan.</p>
                            
                            <form id="addCriteriaForm" class="space-y-4 mt-4">
                                <div>
                                    <label for="criteriaName" class="block text-sm font-medium text-gray-700">Nama Kriteria</label>
                                    <input type="text" id="criteriaName" name="nama_kriteria" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="criteriaDescription" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea id="criteriaDescription" name="deskripsi" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>

                                <div>
                                    <label for="criteriaStatus" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="criteriaStatus" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="pending">Pending</option>
                                        <option value="needs_revision">Needs Revision</option>
                                        <option value="validated">Validated</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="saveCriteria()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tambah Kriteria
                </button>
                <button type="button" onclick="closeAddCriteriaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Sub-Criteria Modal -->
<div id="addSubCriteriaModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Sub-Kriteria Baru</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Masukkan informasi sub-kriteria baru yang akan ditambahkan.</p>
                            
                            <form id="addSubCriteriaForm" class="space-y-4 mt-4">
                                <input type="hidden" id="criteriaId" name="kriteria_id">
                                <div>
                                    <label for="subCriteriaName" class="block text-sm font-medium text-gray-700">Nama Sub-Kriteria</label>
                                    <input type="text" id="subCriteriaName" name="nama_subkriteria" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="subCriteriaDescription" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea id="subCriteriaDescription" name="deskripsi" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="saveSubCriteria()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tambah Sub-Kriteria
                </button>
                <button type="button" onclick="closeAddSubCriteriaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Criteria Modal -->
<div id="editCriteriaModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Kriteria</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Ubah informasi kriteria yang dipilih.</p>
                            
                            <form id="editCriteriaForm" class="space-y-4 mt-4">
                                <input type="hidden" id="editCriteriaId" name="id">
                                <div>
                                    <label for="editCriteriaName" class="block text-sm font-medium text-gray-700">Nama Kriteria</label>
                                    <input type="text" id="editCriteriaName" name="nama_kriteria" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="editCriteriaDescription" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea id="editCriteriaDescription" name="deskripsi" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>

                                <div>
                                    <label for="editCriteriaStatus" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="editCriteriaStatus" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="pending">Pending</option>
                                        <option value="needs_revision">Needs Revision</option>
                                        <option value="validated">Validated</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="updateCriteria()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan Perubahan
                </button>
                <button type="button" onclick="closeEditCriteriaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Sub-Criteria Modal -->
<div id="editSubCriteriaModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Sub-Kriteria</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Ubah informasi sub-kriteria yang dipilih.</p>
                            
                            <form id="editSubCriteriaForm" class="space-y-4 mt-4">
                                <input type="hidden" id="editSubCriteriaId" name="id">
                                <div>
                                    <label for="editSubCriteriaName" class="block text-sm font-medium text-gray-700">Nama Sub-Kriteria</label>
                                    <input type="text" id="editSubCriteriaName" name="nama_subkriteria" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="editSubCriteriaDescription" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea id="editSubCriteriaDescription" name="deskripsi" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="updateSubCriteria()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan Perubahan
                </button>
                <button type="button" onclick="closeEditSubCriteriaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for functionality -->
<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Modal functions
    function openAddCriteriaModal() {
        document.getElementById('addCriteriaModal').classList.remove('hidden');
        document.getElementById('criteriaName').value = '';
        document.getElementById('criteriaDescription').value = '';
        document.getElementById('criteriaStatus').value = 'pending';
    }

    function closeAddCriteriaModal() {
        document.getElementById('addCriteriaModal').classList.add('hidden');
    }

    function openAddSubCriteriaModal(criteriaId) {
        document.getElementById('addSubCriteriaModal').classList.remove('hidden');
        document.getElementById('criteriaId').value = criteriaId;
        document.getElementById('subCriteriaName').value = '';
        document.getElementById('subCriteriaDescription').value = '';
    }

    function closeAddSubCriteriaModal() {
        document.getElementById('addSubCriteriaModal').classList.add('hidden');
    }

    function openEditCriteriaModal(criteriaId) {
        fetch(`/superadmin/criteria/${criteriaId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(criteria => {
            document.getElementById('editCriteriaId').value = criteria.id;
            document.getElementById('editCriteriaName').value = criteria.nama_kriteria;
            document.getElementById('editCriteriaDescription').value = criteria.deskripsi || '';
            document.getElementById('editCriteriaStatus').value = criteria.status;
            document.getElementById('editCriteriaModal').classList.remove('hidden');
        })
        .catch(error => console.error('Error fetching criteria:', error));
    }

    function closeEditCriteriaModal() {
        document.getElementById('editCriteriaModal').classList.add('hidden');
    }

    function openEditSubCriteriaModal(subCriteriaId) {
        fetch(`/superadmin/subcriteria/${subCriteriaId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(subCriteria => {
            document.getElementById('editSubCriteriaId').value = subCriteria.id;
            document.getElementById('editSubCriteriaName').value = subCriteria.nama_subkriteria;
            document.getElementById('editSubCriteriaDescription').value = subCriteria.deskripsi || '';
            document.getElementById('editSubCriteriaModal').classList.remove('hidden');
        })
        .catch(error => console.error('Error fetching sub-criteria:', error));
    }

    function closeEditSubCriteriaModal() {
        document.getElementById('editSubCriteriaModal').classList.add('hidden');
    }

    function saveCriteria() {
        const form = document.getElementById('addCriteriaForm');
        const formData = new FormData(form);
        const url = '/superadmin/criteria';

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeAddCriteriaModal();
                loadCriteria();
                alert('Kriteria berhasil ditambahkan!');
            } else {
                alert('Gagal menambahkan kriteria: ' + (data.message || 'Error tidak diketahui'));
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function saveSubCriteria() {
        const form = document.getElementById('addSubCriteriaForm');
        const formData = new FormData(form);
        const url = '/superadmin/subcriteria';

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeAddSubCriteriaModal();
                loadCriteria();
                alert('Sub-Kriteria berhasil ditambahkan!');
            } else {
                alert('Gagal menambahkan sub-kriteria: ' + (data.message || 'Error tidak diketahui'));
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateCriteria() {
        const form = document.getElementById('editCriteriaForm');
        const formData = new FormData(form);
        const criteriaId = document.getElementById('editCriteriaId').value;
        const url = `/superadmin/criteria/${criteriaId}`;

        fetch(url, {
            method: 'PUT',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeEditCriteriaModal();
                loadCriteria();
                alert('Kriteria berhasil diperbarui!');
            } else {
                alert('Gagal mengupdate kriteria: ' + (data.message || 'Error tidak diketahui'));
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateSubCriteria() {
        const form = document.getElementById('editSubCriteriaForm');
        const formData = new FormData(form);
        const subCriteriaId = document.getElementById('editSubCriteriaId').value;
        const url = `/superadmin/subcriteria/${subCriteriaId}`;

        fetch(url, {
            method: 'PUT',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeEditSubCriteriaModal();
                loadCriteria();
                alert('Sub-Kriteria berhasil diperbarui!');
            } else {
                alert('Gagal mengupdate sub-kriteria: ' + (data.message || 'Error tidak diketahui'));
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function deleteCriteria(criteriaId) {
        if (confirm('Yakin ingin menghapus kriteria ini?')) {
            fetch(`/superadmin/criteria/${criteriaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCriteria();
                    alert('Kriteria berhasil dihapus!');
                } else {
                    alert('Gagal menghapus kriteria: ' + (data.message || 'Error tidak diketahui'));
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function deleteSubCriteria(subCriteriaId) {
        if (confirm('Yakin ingin menghapus sub-kriteria ini?')) {
            fetch(`/superadmin/subcriteria/${subCriteriaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCriteria();
                    alert('Sub-Kriteria berhasil dihapus!');
                } else {
                    alert('Gagal menghapus sub-kriteria: ' + (data.message || 'Error tidak diketahui'));
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    // Load criteria dynamically
    function loadCriteria() {
        fetch('/superadmin/criteria', {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const criteriaList = document.getElementById('criteriaList');
            criteriaList.innerHTML = '';
            data.criteria.forEach(criteria => {
                const div = document.createElement('div');
                div.className = 'bg-white rounded-lg shadow-sm';
                div.innerHTML = `
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4 flex-1">
                                <button onclick="toggleCriteriaExpansion(${criteria.id})" class="p-1 rounded-md hover:bg-gray-100">
                                    <i data-lucide="chevron-right" class="w-4 h-4" id="chevron-${criteria.id}"></i>
                                </button>

                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <i data-lucide="file-text" class="w-5 h-5 text-blue-600"></i>
                                        <h3 class="text-lg font-semibold">${criteria.nama_kriteria}</h3>
                                        <span class="px-2 py-1 text-xs rounded-full ${criteria.status === 'validated' ? 'bg-green-100 text-green-800' : (criteria.status === 'needs_revision' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')}">
                                            ${criteria.status}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 text-sm">${criteria.deskripsi || ''}</p>
                                    <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                        <span>${criteria.subkriteria.length || 0} sub-kriteria</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <button onclick="openAddSubCriteriaModal(${criteria.id})" class="border border-gray-300 hover:bg-gray-50 px-3 py-1 rounded-md text-sm flex items-center">
                                    <i data-lucide="plus" class="w-4 h-4 mr-1"></i>
                                    Sub-Kriteria
                                </button>
                                <button onclick="openEditCriteriaModal(${criteria.id})" class="p-1 rounded-md hover:bg-gray-100">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </button>
                                <button onclick="deleteCriteria(${criteria.id})" class="p-1 rounded-md hover:bg-gray-100 text-red-600 hover:text-red-700">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mt-4 ml-12 space-y-3 hidden" id="subcriteria-${criteria.id}">
                            ${criteria.subkriteria.map(sub => `
                                <div class="bg-white rounded-lg shadow-sm border-l-4 border-l-blue-200">
                                    <div class="p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <i data-lucide="list" class="w-4 h-4 text-gray-500"></i>
                                                <div>
                                                    <h4 class="font-medium">${sub.nama_subkriteria}</h4>
                                                    <p class="text-sm text-gray-600">${sub.deskripsi || ''}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button onclick="openEditSubCriteriaModal(${sub.id})" class="p-1 rounded-md hover:bg-gray-100">
                                                    <i data-lucide="edit" class="w-3 h-3"></i>
                                                </button>
                                                <button onclick="deleteSubCriteria(${sub.id})" class="p-1 rounded-md hover:bg-gray-100 text-red-600 hover:text-red-700">
                                                    <i data-lucide="trash-2" class="w-3 h-3"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
                criteriaList.appendChild(div);
            });
            lucide.createIcons(); // Reinitialize icons
        })
        .catch(error => console.error('Error loading criteria:', error));
    }

    // Toggle criteria expansion
    function toggleCriteriaExpansion(criteriaId) {
        const subcriteriaDiv = document.getElementById(`subcriteria-${criteriaId}`);
        const chevronIcon = document.getElementById(`chevron-${criteriaId}`);
        
        if (subcriteriaDiv.classList.contains('hidden')) {
            subcriteriaDiv.classList.remove('hidden');
            chevronIcon.setAttribute('data-lucide', 'chevron-down');
        } else {
            subcriteriaDiv.classList.add('hidden');
            chevronIcon.setAttribute('data-lucide', 'chevron-right');
        }
        
        lucide.createIcons();
    }

    // Filter criteria based on search
    function filterCriteria() {
        const searchQuery = document.getElementById('searchInput').value.toLowerCase();
        const criteriaCards = document.querySelectorAll('#criteriaList > div');
        
        criteriaCards.forEach(card => {
            const criteriaName = card.querySelector('h3').textContent.toLowerCase();
            const criteriaDesc = card.querySelector('p.text-gray-600')?.textContent.toLowerCase() || '';
            const subCriteriaNames = Array.from(card.querySelectorAll('#subcriteria-' + card.querySelector('button').getAttribute('onclick').match(/\d+/)[0] + ' h4'))
                .map(h4 => h4.textContent.toLowerCase());
            const subCriteriaDescs = Array.from(card.querySelectorAll('#subcriteria-' + card.querySelector('button').getAttribute('onclick').match(/\d+/)[0] + ' p'))
                .map(p => p.textContent.toLowerCase());

            const matchesCriteria = criteriaName.includes(searchQuery) || criteriaDesc.includes(searchQuery);
            const matchesSubCriteria = subCriteriaNames.some(name => name.includes(searchQuery)) || subCriteriaDescs.some(desc => desc.includes(searchQuery));

            if (matchesCriteria || matchesSubCriteria) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Initial load
    document.addEventListener('DOMContentLoaded', function() {
        loadCriteria();
    });
</script>
@endsection