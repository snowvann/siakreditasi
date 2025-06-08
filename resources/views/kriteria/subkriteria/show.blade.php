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
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    }
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .card-hover {
        transition: all 0.3s ease;
        transform: translateY(0);
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.1);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, var(--primary), var(--primary-dark));
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }
    
    .floating-label {
        position: relative;
    }
    
    .floating-label input:focus + label,
    .floating-label input:not(:placeholder-shown) + label {
        transform: translateY(-20px) scale(0.8);
        color: var(--primary);
    }
    
    .floating-label label {
        position: absolute;
        left: 12px;
        top: 12px;
        color: var(--gray-500);
        transition: all 0.3s ease;
        pointer-events: none;
        background: white;
        padding: 0 4px;
    }
    
    .modal-backdrop {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(8px);
    }
    
    .pulse-ring {
        animation: pulse-ring 1.5s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
    }
    
    @keyframes pulse-ring {
        0% { transform: scale(0.8); }
        40%, 50% { opacity: 0; }
        100% { transform: scale(1.2); opacity: 0; }
    }
    
    .icon-bounce {
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
</style>

<div class="min-h-screen" style="background: linear-gradient(135deg, var(--light) 0%, var(--gray-50) 100%);">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">

            {{-- Enhanced Header with Gradient --}}
            <div class="gradient-bg rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white opacity-5 rounded-full -ml-16 -mb-16"></div>
                
                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center gap-4">
                    <a href="{{ route('kriteria.show', $kriteriaId) }}" 
                       class="inline-flex items-center justify-center rounded-full text-white bg-white bg-opacity-20 hover:bg-opacity-30 transition-all duration-300 h-12 w-12 group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                             class="h-5 w-5 group-hover:-translate-x-1 transition-transform duration-300">
                            <path d="m12 19-7-7 7-7"></path>
                            <path d="M19 12H5"></path>
                        </svg>
                    </a>
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold mb-2">{{ $subKriteria['nama_subkriteria'] }}</h1>
                        <div class="flex items-center gap-2">
                            <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm font-medium">
                                Kriteria {{ $kriteriaId }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Success Alert with Animation --}}
            @if(session('status'))
                <div class="mb-6 bg-white border-l-4 border-green-500 rounded-lg shadow-lg p-4 transform transition-all duration-500 hover:scale-105" 
                     style="border-left-color: var(--success);">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium" style="color: var(--success);">
                                <strong>Sukses!</strong> {{ session('status') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Enhanced Form Card --}}
            <form method="POST" action="{{ route('kriteria.subkriteria.simpanIsian', [$kriteriaId, $subKriteria['id']]) }}" enctype="multipart/form-data">
                @csrf
            
                <div class="glass-effect rounded-2xl shadow-2xl card-hover overflow-hidden">
                    {{-- Card Header --}}
                    <div class="bg-white border-b border-gray-100 p-8">
                        <div class="flex items-center gap-4">
                            <div class="p-3 rounded-full" style="background: linear-gradient(45deg, var(--primary), var(--accent));">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold" style="color: var(--dark);">Isi Sub-kriteria</h2>
                                <p class="text-gray-600 mt-1">
                                    Masukkan informasi sesuai dengan panduan akreditasi.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-8 space-y-8" style="background-color: var(--gray-50);">
                        {{-- Upload Button with Enhanced Design --}}
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold mb-3" style="color: var(--gray-700);">
                                Upload Gambar Pendukung
                            </label>
                            <button type="button" onclick="openImageUploadModal()"
                                class="btn-primary inline-flex items-center justify-center rounded-xl text-sm font-semibold text-white px-6 py-3 shadow-lg">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Upload Gambar
                            </button>
                        </div>

                        {{-- Enhanced Textarea --}}
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold" style="color: var(--gray-700);">
                                Konten Sub-kriteria
                            </label>
                            <div class="relative">
                                <textarea id="nilai" name="nilai" 
                                    class="w-full p-4 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-4 focus:ring-primary focus:ring-opacity-20 transition-all duration-300" 
                                    rows="10" 
                                    style="border-color: var(--gray-300); min-height: 300px;">{{ old('nilai', $akreditasiIsi) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Enhanced Action Buttons --}}
                    <div class="bg-white border-t border-gray-100 p-8">
                        <div class="flex flex-col sm:flex-row sm:justify-end gap-4">
                            <button type="submit" name="action" value="submit"
                                class="inline-flex items-center justify-center rounded-xl text-sm font-semibold px-6 py-3 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                                style="background: linear-gradient(45deg, var(--primary), var(--primary-dark));">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Submit
                            </button>
                            
                            <a href="{{ url()->current() }}"
                                class="inline-flex items-center justify-center rounded-xl text-sm font-semibold px-6 py-3 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                                style="background: linear-gradient(45deg, var(--danger), #dc2626);">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel
                            </a>

                            
                            <button type="submit" name="action" value="reset"
                                class="inline-flex items-center justify-center rounded-xl text-sm font-semibold px-6 py-3 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                                style="background: linear-gradient(45deg, var(--warning), #d97706);">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Enhanced Image Upload Modal --}}
            <div id="imageUploadModal" class="fixed inset-0 z-50 hidden modal-backdrop flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="imageModalContent">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold" style="color: var(--dark);">Upload Gambar</h2>
                            <button type="button" onclick="closeImageUploadModal()" 
                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="space-y-3">
                            <label for="imageFileInput" class="block text-sm font-semibold text-gray-900">
                                Pilih File Gambar
                            </label>
                            <input type="file" id="imageFileInput" accept="image/*" 
                                class="block w-full border-2 border-gray-300 rounded-xl p-3 text-sm
                                       file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 
                                       file:text-sm file:font-bold file:text-white file:shadow-lg
                                       hover:file:shadow-xl hover:file:scale-105 focus:border-primary focus:ring-2 
                                       focus:ring-primary focus:ring-opacity-20 transition-all duration-300
                                       file:cursor-pointer file:transition-all file:duration-300"
                                style="file:background: linear-gradient(45deg, var(--primary), var(--primary-dark)); 
                                       file:box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);">
                            <p class="text-xs text-gray-500 mt-2">Format: PNG, JPG. Maksimal ukuran: 5MB</p>
                        </div>
                    </div>
                    
                    <div class="p-6 border-t border-gray-100 flex justify-end space-x-3">
                        <button type="button" onclick="closeImageUploadModal()" 
                            class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="button" onclick="uploadImage()" 
                            class="px-6 py-2 rounded-xl text-white font-semibold transition-all duration-300 hover:shadow-lg"
                            style="background: linear-gradient(45deg, var(--primary), var(--primary-dark));">
                            Upload
                        </button>
                    </div>
                </div>
            </div>

            {{-- Enhanced Document Upload Modal --}}
            <div id="documentUploadModal" class="fixed inset-0 z-50 hidden modal-backdrop flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-xl font-bold" style="color: var(--dark);">Upload Dokumen</h2>
                    </div>
                    <div class="p-6">
                        <input type="file" id="documentFileInput" accept=".jpg,.jpeg,.png,.pdf" 
                            class="block w-full border border-gray-300 rounded-xl p-3 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20">
                    </div>
                    <div class="p-6 border-t border-gray-100 flex justify-end space-x-3">
                        <button type="button" onclick="closeDocumentModal()" 
                            class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="button" onclick="handleDocumentUpload()" 
                            class="px-6 py-2 rounded-xl text-white font-semibold"
                            style="background: linear-gradient(45deg, var(--primary), var(--primary-dark));">
                            Gunakan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.tiny.cloud/1/ms9mibzuiskzzrxton0318ttxen3nu7s2ne7m8xwux80xq84/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    // Initialize TinyMCE first
    tinymce.init({
        selector: '#nilai',
        plugins: 'link image code lists',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
        height: 500,
        content_style: "img { max-width: 100%; height: auto; }",
        setup: function (editor) {
            editor.on('init', function () {
                console.log('TinyMCE initialized successfully');
            });
        }
    });

    // Enhanced modal animations
    function openImageUploadModal() {
        const modal = document.getElementById('imageUploadModal');
        const content = document.getElementById('imageModalContent');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }
    
    function closeImageUploadModal() {
        const modal = document.getElementById('imageUploadModal');
        const content = document.getElementById('imageModalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.getElementById('imageFileInput').value = '';
        }, 300);
    }
    
    function uploadImage() {
        const input = document.getElementById('imageFileInput');
        const file = input.files[0];
    
        if (!file) {
            alert('Pilih gambar terlebih dahulu.');
            return;
        }
    
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!allowedTypes.includes(file.type)) {
            alert('Hanya gambar JPG atau PNG yang diizinkan.');
            return;
        }

        // Check if file size is reasonable (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 5MB.');
            return;
        }
    
        const formData = new FormData();
        formData.append('file', file);
        formData.append('_token', '{{ csrf_token() }}');
    
        // Show loading state
        const uploadButton = document.querySelector('#imageUploadModal button[onclick="uploadImage()"]');
        const originalText = uploadButton.textContent;
        uploadButton.textContent = 'Mengupload...';
        uploadButton.disabled = true;

        fetch('{{ route('kriteria.subkriteria.simpanIsian', [$kriteriaId, $subKriteria['id']]) }}', {
            method: 'POST',
            headers: { 
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.url) {
                // Wait for TinyMCE to be ready before inserting content
                if (tinymce.get('nilai')) {
                    tinymce.get('nilai').insertContent(`<p><img src="${data.url}" style="max-width:100%; height:auto;" alt="Uploaded image" /></p>`);
                } else {
                    // Fallback: insert directly to textarea
                    const textarea = document.getElementById('nilai');
                    textarea.value += `\n<img src="${data.url}" style="max-width:100%; height:auto;" alt="Uploaded image" />\n`;
                }
                closeImageUploadModal();
                alert('Gambar berhasil diupload!');
            } else {
                throw new Error(data.error || 'Upload gagal');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            alert('Terjadi kesalahan saat upload: ' + error.message);
        })
        .finally(() => {
            // Reset button state
            uploadButton.textContent = originalText;
            uploadButton.disabled = false;
        });
    }

    // Document Upload Modal Functions (if needed)
    function closeDocumentModal() {
        document.getElementById('documentUploadModal').classList.add('hidden');
        document.getElementById('documentFileInput').value = '';
    }
    
    function handleDocumentUpload() {
        // Implement document upload logic here if needed
        closeDocumentModal();
    }

    // Enhanced file input handling
    document.getElementById('imageFileInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Visual feedback that file is selected
            const fileInfo = document.createElement('div');
            fileInfo.className = 'mt-2 text-sm text-primary font-medium';
            fileInfo.textContent = `File dipilih: ${file.name}`;
            
            // Remove any existing file info
            const existingInfo = this.parentNode.querySelector('.file-selected-info');
            if (existingInfo) {
                existingInfo.remove();
            }
            
            fileInfo.className += ' file-selected-info';
            this.parentNode.appendChild(fileInfo);
        }
    });

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-backdrop')) {
            closeImageUploadModal();
            closeDocumentModal();
        }
    });
</script>

@endsection