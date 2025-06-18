@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    @include('components.dashboard-header')
    
    <main class="container mx-auto px-4 py-8">
        
        <!-- Header Section -->
                <div class="relative rounded-xl bg-gradient-to-r from-purple-700 to-pink-500 text-white p-6 flex items-center justify-between shadow-lg">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-3xl opacity-10 blur-xl"></div>      

                <!-- Konten Header -->
                <div class="flex items-center gap-4 relative z-10">
                    <!-- Tombol Back -->
                    <a href="{{ route('superadmin.dashboard') }}"
                        class="inline-flex items-center justify-center text-white hover:text-gray-100 bg-white/10 hover:bg-white/20 p-2 rounded-full transition-all duration-300">
                        <!-- Icon Back (Heroicon) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                <div class="space-y-4">
                    <h1 class="text-3xl lg:text-4xl font-bold text-white">
                        Manajemen Pengguna
                    </h1>
                    <p class="text-white/90 text-lg">Kelola pengguna dan hak akses mereka secara efisien</p>
                </div>
                </div>

                <div class="text-4xl">
                    <!-- Ikon user solid seperti di gambar -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-10 h-10" viewBox="0 0 20 20">
                        <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 0114 0H3z" />
                    </svg>
                </div>
            </div>

        <!-- Filters -->
            <div class="p-6">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1 relative">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                        <input 
                            type="text" 
                            placeholder="Cari user berdasarkan nama atau username..." 
                            class="w-full pl-10 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="searchInput"
                            oninput="filterUsers()"
                        >
                    </div>
                    <select 
                        id="roleFilter" 
                        class="w-48 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="filterUsers()"
                    >
                        <option value="all">Semua Peran</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="validator">Validator</option>
                        <option value="anggota">Anggota</option>
                    </select>
                </div>
            </div>

             <!-- Header Actions -->
            <div class="container mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <!-- Add User Button -->
                <button onclick="openAddUserModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                 Tambah User
            </button>
            </div>


        <!-- Users Table -->
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Daftar User (<span id="userCount">{{ $users->total() }}</span>)</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            <thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="userTableBody">
                                    @foreach ($users as $user)
                                    <tr class="user-row" data-id="{{ $user->id }}" data-role="{{ strtolower($user->role) }}" data-search="{{ $user->name }} {{ $user->username }}">
                                        
                                <!-- Nama -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-xs font-medium text-gray-900">
                                            {{ $user->name }}
                                      </div>
                                            </td>

                                <!-- Username -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center items-center gap-2 text-sm">
                                            <i data-lucide="user" class="w-3 h-3"></i>
                                             <span>{{ $user->username }}</span>
                                        </div>
                                        </td>

                                <!-- Role -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                  <span class="px-2 py-1 text-xs rounded-full 
                                      {{ $user->role === 'superadmin' ? 'bg-indigo-100 text-indigo-800' : 
                                        ($user->role === 'validator' ? 'bg-blue-100 text-blue-800' : 
                                        'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($user->role) }}
                                            </span>
                                                </td>        
                                    <td class="px-2 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center justify-center gap-1 px-3 py-1 text-xs font-semibold 
                                        {{ $user->is_active ? 'bg-green-300 text-green-900' : 'bg-red-300 text-red-900' }} rounded-full">
                                        <i data-lucide="{{ $user->is_active ? 'user-check' : 'user-x' }}" class="w-3 h-3"></i>
                                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Tombol Edit -->
                                            <button onclick="openEditUserModal({{ $user->id }})"
                                                class="text-white bg-yellow-400 hover:bg-yellow-500 rounded-full px-4 py-2 transition-colors duration-200 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 fill-current" viewBox="0 0 24 24">
                                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM21.41 6.34a1.25 1.25 0 0 0 0-1.77l-2.98-2.98a1.25 1.25 0 0 0-1.77 0l-1.83 1.83 4.75 4.75 1.83-1.83z"/>
                                                </svg>
                                                <span>Ubah</span>
                                            </button>
                                            <!-- Tombol Hapus -->
                                            <button onclick="if(confirm('Yakin ingin menghapus user {{ $user->name }}?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }"
                                                class="text-white bg-red-600 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-200 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 fill-current" viewBox="0 0 24 24">
                                                    <path d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('superadmin.users.create')
    @include('superadmin.users.edit')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        lucide.createIcons();

        function openAddUserModal() {
            document.getElementById('addUserModal').classList.remove('hidden');
            document.getElementById('userId').value = 0;
            document.getElementById('name').value = '';
            document.getElementById('username').value = '';
            document.getElementById('role').value = 'anggota';
            document.getElementById('is_active').value = '1';
        }

        function closeAddUserModal() {
            document.getElementById('addUserModal').classList.add('hidden');
        }

        function closeEditUserModal() {
            document.getElementById('editUserModal').classList.add('hidden');
        }

        function openEditUserModal(userId) {
            fetch(`/superadmin/manage/user/${userId}/data`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const form = document.getElementById('editUserForm');
                        form.action = `/superadmin/manage/user/${data.data.id}`;
                        document.getElementById('editUserId').value = data.data.id;
                        document.getElementById('editName').value = data.data.name;
                        document.getElementById('editUsername').value = data.data.username;
                        document.getElementById('editRole').value = data.data.role;
                        document.getElementById('editIsActive').value = data.data.is_active ? '1' : '0';
                        document.getElementById('editUserModal').classList.remove('hidden');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Gagal memuat data user',
                            showConfirmButton: true
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat memuat data user',
                        showConfirmButton: true
                    });
                });
        }

        function filterUsers() {
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            const roleFilter = document.getElementById('roleFilter').value;
            const rows = document.querySelectorAll('.user-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const matchesSearch = row.getAttribute('data-search').toLowerCase().includes(searchQuery);
                const matchesRole = roleFilter === 'all' || row.getAttribute('data-role') === roleFilter;
                
                if (matchesSearch && matchesRole) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            document.getElementById('userCount').textContent = visibleCount;
        }

        function addUser() {
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            formData.append('name', document.getElementById('name').value);
            formData.append('username', document.getElementById('username').value);
            formData.append('role', document.getElementById('role').value);
            formData.append('is_active', document.getElementById('is_active').value);

            fetch('/superadmin/manage/user/store', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'User berhasil ditambahkan',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => location.reload());
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Gagal menambahkan user',
                        showConfirmButton: true
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menambahkan user',
                    showConfirmButton: true
                });
            });
        }

        function deleteUser(userId) {
            Swal.fire({
                title: 'Yakin ingin menghapus user ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/superadmin/manage/user/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Delete gagal');
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'User berhasil dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => location.reload());
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal menghapus user',
                            showConfirmButton: true
                        });
                    });
                }
            });
        }

        function submitEditUserForm() {
    const form = document.getElementById('editUserForm');
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    // Disable the submit button to prevent multiple submissions
    const submitButton = form.querySelector('button[type="button"][onclick="submitEditUserForm()"]');
    if (submitButton) submitButton.disabled = true;

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Response Status:', response.status);
        console.log('Response Headers:', response.headers);
        return response.json().then(data => ({
            status: response.status,
            data: data
        }));
    })
    .then(({ status, data }) => {
        // Re-enable the submit button
        if (submitButton) submitButton.disabled = false;

        if (status >= 200 && status < 300 && data.success) {
            // Close modal immediately on success
            closeEditUserModal();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message || 'User berhasil diperbarui',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                updateUserRow(data.data);
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message || 'Terjadi kesalahan saat memperbarui user',
                showConfirmButton: true
            }).then(() => {
                // Keep modal open on error for user to correct
            });
        }
    })
    .catch(error => {
        // Re-enable the submit button on error
        if (submitButton) submitButton.disabled = false;
        console.error('Error in submitEditUserForm:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: error.message || 'Terjadi kesalahan saat memperbarui user',
            showConfirmButton: true
        }).then(() => {
            // Keep modal open on error for user to correct
        });
    });
}

        function updateUserRow(userData) {
            const row = document.querySelector(`.user-row[data-id="${userData.id}"]`);
            if (!row) return;

            row.setAttribute('data-search', `${userData.name} ${userData.username}`);
            row.setAttribute('data-role', userData.role.toLowerCase());

            const nameCell = row.querySelector('td:nth-child(1) .text-sm.font-medium');
            if (nameCell) nameCell.textContent = userData.name;

            const usernameCell = row.querySelector('td:nth-child(2) span');
            if (usernameCell) usernameCell.textContent = userData.username;

            const roleCell = row.querySelector('td:nth-child(3) span');
            if (roleCell) {
                roleCell.textContent = userData.role.charAt(0).toUpperCase() + userData.role.slice(1);
                roleCell.className = 'px-2 py-1 text-xs rounded-full ';
                if (userData.role === 'superadmin') {
                    roleCell.className += 'bg-indigo-100 text-indigo-800';
                } else if (userData.role === 'validator') {
                    roleCell.className += 'bg-blue-100 text-blue-800';
                } else {
                    roleCell.className += 'bg-gray-100 text-gray-800';
                }
            }

            const statusCell = row.querySelector('td:nth-child(4) span');
            if (statusCell) {
                const isActive = userData.is_active;
                statusCell.innerHTML = `<i data-lucide="${isActive ? 'user-check' : 'user-x'}" class="w-3 h-3"></i> ${isActive ? 'Aktif' : 'Nonaktif'}`;
                statusCell.className = `px-2 py-1 text-xs rounded-full flex items-center gap-1 ${isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
            }

            lucide.createIcons();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection