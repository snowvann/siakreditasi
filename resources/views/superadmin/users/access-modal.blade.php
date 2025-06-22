<!-- Modal Hak Akses -->
<div id="accessModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <h3 class="text-xl font-bold mb-4">Edit Hak Akses</h3>
            <p class="text-gray-600 mb-6">Perbarui hak akses user yang dipilih.</p>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">User</label>
                <input type="text" id="accessUserName" class="w-full border border-gray-300 rounded-md px-3 py-2" readonly>
                <input type="hidden" id="accessUserId">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kriteria</label>
                <select id="accessKriteria" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="1">Kriteria 1: Visi, Misi, Tujuan dan Strategi</option>
                    <option value="2">Kriteria 2: Tata Pamong, Tata Kelola dan Kerjasama</option>
                    <option value="3">Kriteria 3: Mahasiswa</option>
                    <option value="4">Kriteria 4: Sumber Daya Manusia</option>
                </select>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Hak Akses</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" id="readAccess" class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2">Baca - Dapat melihat konten kriteria</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" id="writeAccess" class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2">Tulis - Dapat mengedit dan mengisi kriteria</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" id="validateAccess" class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2">Validasi - Dapat memvalidasi kriteria</span>
                    </label>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeAccessModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button onclick="updateUserAccess()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Perbarui Akses
                </button>
            </div>
        </div>
    </div>
</div>