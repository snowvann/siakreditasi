@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 py-6">
        <div class="grid gap-6">

            {{-- Header dengan tombol kembali, judul, status --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <a href="{{ route('kriteria.show', $kriteriaId) }}" 
                   class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium 
                          ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 
                          focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 
                          hover:bg-accent hover:text-accent-foreground h-9 w-9">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                         class="h-4 w-4">
                        <path d="m12 19-7-7 7-7"></path>
                        <path d="M19 12H5"></path>
                    </svg>
                </a>
                <div class="flex-1">
                    <h1 class="text-2xl font-bold">
                        {{ $subKriteria['nama_subkriteria'] }}
                    </h1>
                    <p class="text-sm text-muted-foreground">Kriteria {{ $kriteriaId }}</p>
                </div>
                <x-status-badge :status="$subKriteria['status']" />
            </div>

                        {{-- Tabs --}}
                <div>
                    <div class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground">
                        <button 
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium 
                                ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring 
                                focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-background text-foreground shadow-sm">
                            Konten
                        </button>
                    </div>

                                @if(session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif


                    {{-- Content Tab --}}
                    <form method="POST" action="{{ route('kriteria.subkriteria.simpanIsian', [$kriteriaId, $subKriteria['id']]) }}" enctype="multipart/form-data">
                        @csrf
                    
                            <div class="mt-6">
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold">Isi Sub-kriteria</h2>
                                        <p class="text-sm text-muted-foreground">
                                            {{ $subKriteria['status'] === 'validated' 
                                                ? 'Konten ini telah divalidasi dan tidak dapat diubah.' 
                                                : 'Masukkan informasi sesuai dengan panduan akreditasi.' 
                                            }}
                                        </p>
                                    </div>
                                    <div class="bg-gray-50 px-6 pb-6 space-y-4">
                                        @if($subKriteria['status'] !== 'validated')
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Dokumen Pendukung</label>
                                                <button type="button" onclick="openModal()"
                                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium 
                                                    bg-indigo-600 text-white hover:bg-indigo-700 h-9 px-4 py-2">
                                                Upload Dokumen
                                            </button>
                                            
                                            </button>
                                            

                                            </div>
                                        @endif
                                        <textarea id="nilai" name="nilai" rows="10" class="bg-white p-2 border rounded w-full" {{ $subKriteria['status'] === 'validated' ? 'disabled' : '' }}>{{ $akreditasiIsi }}</textarea>

              


                                    </div>

                                    <div class="p-6 pt-0 border-t">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                                            <div class="text-sm text-muted-foreground">
                                            </div>
                                            <div class="flex flex-wrap gap-2">
                                                @if($subKriteria['status'] !== 'validated')
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
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </form>
                   <!-- Modal Upload Dokumen -->
<div id="uploadModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-lg font-semibold mb-4">Pilih Dokumen</h2>
        <input type="file" id="modalFileInput" accept=".jpg,.jpeg,.png,.pdf" class="block w-full mb-4">
        <div class="flex justify-end space-x-2">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
            <button onclick="handleFileUpload()" class="px-4 py-2 bg-blue-600 text-white rounded">Gunakan</button>
        </div>
    </div>
</div>



                        </div>


                {{-- Attachments Tab 
                <div x-show="activeTab === 'attachments'" class="mt-6">
                    @include('components.file-upload', [
                        'existingFile' => $akreditasi['file_path'],
                        'isDisabled' => $subKriteria['status'] === 'validated'
                    ])
                </div>
            </div>--}}

        </div>
    </main>
</div>

<script>
    function openModal() {
        document.getElementById('uploadModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('uploadModal').classList.add('hidden');
        document.getElementById('modalFileInput').value = '';
    }

    function handleFileUpload() {
        const input = document.getElementById('modalFileInput');
        const file = input.files[0];

        if (!file) {
            alert('Silakan pilih file terlebih dahulu.');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);
        formData.append('_token', '{{ csrf_token() }}');

        fetch("{{ route('kriteria.subkriteria.simpanIsian', [$kriteriaId, $subKriteria['id']]) }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.url) {
                const textarea = document.getElementById('nilai');
                textarea.value += `\n${data.url}\n`;
                closeModal();
            } else {
                alert(data.error || 'Terjadi kesalahan saat upload.');
            }
        })
        .catch(() => {
            alert('Upload gagal. Periksa koneksi atau coba lagi.');
        });
    }
</script>



@endsection
