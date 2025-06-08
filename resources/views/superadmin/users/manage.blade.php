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
                        Manajemen User
                    </h1>
                    <p class="text-gray-600 text-lg">Kelola pengguna dan hak akses mereka secara efisien</p>
                </div>
                
                <!-- Enhanced Search -->
                <div class="w-full lg:w-96">
                    <form method="GET" action="{{ route('superadmin.manage.users') }}" class="relative group">
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
                                placeholder="Cari user berdasarkan nama atau username..."
                                class="w-full pl-12 pr-6 py-4 bg-transparent border-0 rounded-2xl focus:outline-none focus:ring-0 text-gray-700 placeholder-gray-400"
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Actions -->
    <div class="container mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <!-- Add User Button - Will trigger modal -->
        <button onclick="openAddUserModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Tambah User
        </button>
    </div>

    <!-- Filters -->
    <div class="container mx-auto px-6">
        <div class="bg-white rounded-lg shadow-sm">
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
        </div>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Login Terakhir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="userTableBody">
                            @foreach ($users as $user)
                            <tr class="user-row" data-role="{{ $user->role }}" data-search="{{ $user->name }} {{ $user->username }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                                            {{ strtoupper(substr($user->name, 0, 1)) . strtoupper(substr($user->name, strpos($user->name, ' ') + 1, 1) ?: '') }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->username }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2 text-sm">
                                            <i data-lucide="user" class="w-3 h-3"></i>
                                            <span>{{ $user->username }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $user->role === 'SuperAdmin' ? 'bg-indigo-100 text-indigo-800' : ($user->role === 'Validator' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} flex items-center gap-1">
                                        <i data-lucide="{{ $user->is_active ? 'user-check' : 'user-x' }}" class="w-3 h-3"></i>
                                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Belum login' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openEditUserModal({{ $user->id }})" class="text-blue-600 hover:text-blue-800">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                        <button onclick="if(confirm('Yakin ingin menghapus user {{ $user->name }}?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }" class="text-red-600 hover:text-red-800">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                        {{-- <form id="delete-form-{{ $user->id }}" action="{{ route('superadmin.delete.user', $user->id) }}" method="POST" style="display: none;"> --}}
                                            @csrf
                                            @method('DELETE')
                                        </form>
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

<!-- Add User Modal -->
<div id="addUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambah User Baru</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Masukkan informasi user baru yang akan ditambahkan ke sistem.</p>
                            
                            {{-- <form id="addUserForm" action="{{ route('superadmin.update.user') }}" method="POST" class="space-y-4 mt-4"> --}}
                                @csrf
                                <input type="hidden" name="id" id="userId" value="0">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                        <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                        <input type="text" id="username" name="username" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="role" class="block text-sm font-medium text-gray-700">Peran</label>
                                        <select id="role" name="role" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="anggota">Anggota</option>
                                            <option value="validator">Validator</option>
                                            <option value="superadmin">Super Admin</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
                                        <select id="is_active" name="is_active" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="saveUser()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tambah User
                </button>
                <button type="button" onclick="closeAddUserModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit User</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Ubah informasi user yang dipilih.</p>
                            
                            {{-- <form id="editUserForm" action="{{ route('superadmin.update.user') }}" method="POST" class="space-y-4 mt-4"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="editUserId">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="editName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                        <input type="text" id="editName" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="editUsername" class="block text-sm font-medium text-gray-700">Username</label>
                                        <input type="text" id="editUsername" name="username" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="editRole" class="block text-sm font-medium text-gray-700">Peran</label>
                                        <select id="editRole" name="role" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="anggota">Anggota</option>
                                            <option value="validator">Validator</option>
                                            <option value="superadmin">Super Admin</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="editIsActive" class="block text-sm font-medium text-gray-700">Status</label>
                                        <select id="editIsActive" name="is_active" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="updateUser()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan Perubahan
                </button>
                <button type="button" onclick="closeEditUserModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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

    function openEditUserModal(userId) {
        fetch(`/superadmin/manage/user/${userId}`)
            .then(response => response.json())
            .then(user => {
                document.getElementById('editUserId').value = user.id;
                document.getElementById('editName').value = user.name;
                document.getElementById('editUsername').value = user.username;
                document.getElementById('editRole').value = user.role;
                document.getElementById('editIsActive').value = user.is_active ? '1' : '0';
                document.getElementById('editUserModal').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
    }

    function closeEditUserModal() {
        document.getElementById('editUserModal').classList.add('hidden');
    }

    function saveUser() {
        const form = document.getElementById('addUserForm');
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal menambahkan user: ' + (data.message || 'Error tidak diketahui'));
            }
        })
        .catch(error => console.error('Error:', error));

        closeAddUserModal();
    }

    function updateUser() {
        const form = document.getElementById('editUserForm');
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal mengupdate user: ' + (data.message || 'Error tidak diketahui'));
            }
        })
        .catch(error => console.error('Error:', error));

        closeEditUserModal();
    }

    // Filter users based on search and role
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
</script>
@endsection