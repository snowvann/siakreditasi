@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <a href="{{ route('kriteria.show', $kriteriaId) }}" 
                   class="inline-flex items-center justify-center rounded-md text-sm font-medium 
                          ring-offset-background hover:bg-accent hover:text-accent-foreground h-9 w-9">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                         class="h-4 w-4">
                        <path d="m12 19-7-7 7-7"></path>
                        <path d="M19 12H5"></path>
                    </svg>
                </a>
                <div class="flex-1">
                    <h1 class="text-2xl font-bold">{{ $subKriteria['nama_subkriteria'] }}</h1>
                    <p class="text-sm text-muted-foreground">Kriteria {{ $kriteriaId }}</p>
                </div>
            </div>

            {{-- Tabs --}}
            <div>
                <div class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground">
                    <button class="inline-flex items-center justify-center rounded-sm px-3 py-1.5 text-sm font-medium 
                                   bg-background text-foreground shadow-sm">
                        Konten
                    </button>
                </div>

                @if(session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Sukses!</strong>
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('kriteria.subkriteria.simpanIsian', [$kriteriaId, $subKriteria['id']]) }}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="mt-6">
                        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold">Isi Sub-kriteria</h2>
                                <p class="text-sm text-muted-foreground">
                                    Masukkan informasi sesuai dengan panduan akreditasi.
                                </p>
                            </div>
                            <div class="bg-gray-50 px-6 pb-6 space-y-4">
                                <!-- Tombol untuk membuka modal -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar Pendukung</label>
                                    <button type="button" onclick="openImageUploadModal()"
                                        class="inline-flex items-center justify-center rounded-md text-sm font-medium 
                                            bg-indigo-600 text-white hover:bg-indigo-700 h-9 px-4 py-2">
                                        Upload Gambar
                                    </button>
                                </div>

                                <!-- Modal Upload Gambar (Fixed ID) -->
                                <div id="imageUploadModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                                        <h2 class="text-lg font-semibold mb-4">Pilih Gambar</h2>
                                        <input type="file" id="imageFileInput" accept="image/*" class="block w-full mb-4">
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" onclick="closeImageUploadModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                                            <button type="button" onclick="uploadImage()" class="px-4 py-2 bg-blue-600 text-white rounded">Upload</button>
                                        </div>
                                    </div>
                                </div>

                                <textarea id="nilai" name="nilai" class="bg-white p-2 border rounded w-full" rows="10">{{ old('nilai', $akreditasiIsi) }}</textarea>
                            </div>

                            <div class="p-6 pt-0 border-t">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                                    <div class="text-sm text-muted-foreground"></div>
                                    <div class="flex flex-wrap gap-2">
                                        <button type="submit" name="action" value="submit"
                                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium 
                                            ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 
                                            focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                                            bg-blue-600 text-white hover:bg-blue-700 h-9 px-4 py-2">
                                        Submit
                                    </button>
                                    <a href="{{ url()->current() }}"
                                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium 
                                            ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 
                                            focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                                            bg-red-500 text-white hover:bg-red-600 h-9 px-4 py-2">
                                        Cancel
                                    </a>
                                    <button type="submit" name="action" value="save"
                                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium 
                                            ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 
                                            focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                                            bg-green-600 text-white hover:bg-green-700 h-9 px-4 py-2">
                                        Save
                                    </button>
                                    <button type="submit" name="action" value="reset"
                                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium 
                                            ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 
                                            focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                                            bg-yellow-400 hover:bg-yellow-500 text-white  h-9 px-4 py-2">
                                        Reset
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Modal Upload Dokumen (Separate from image modal) -->
                <div id="documentUploadModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                        <h2 class="text-lg font-semibold mb-4">Pilih Dokumen</h2>
                        <input type="file" id="documentFileInput" accept=".jpg,.jpeg,.png,.pdf" class="block w-full mb-4">
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeDocumentModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                            <button type="button" onclick="handleDocumentUpload()" class="px-4 py-2 bg-blue-600 text-white rounded">Gunakan</button>
                        </div>
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

    // Image Upload Modal Functions
    function openImageUploadModal() {
        document.getElementById('imageUploadModal').classList.remove('hidden');
    }
    
    function closeImageUploadModal() {
        document.getElementById('imageUploadModal').classList.add('hidden');
        document.getElementById('imageFileInput').value = '';
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
</script>

@endsection