@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    @include('components.dashboard-header')

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-green-800 font-semibold">Berhasil!</h4>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-red-800 font-semibold">Error!</h4>
                        <p class="text-red-700 text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-red-800 font-semibold">Terdapat kesalahan:</h4>
                        <ul class="text-red-700 text-sm mt-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Modern Header with Glass Effect -->
        <div class="mb-8">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg border border-white/20 p-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <!-- Back Button -->
                    <a 
                    href="{{ route('validator.dashboard') }}" 
                    class="inline-flex items-center justify-center w-10 h-10 bg-white rounded-xl shadow-md border border-gray-200 text-gray-600 hover:text-indigo-600 hover:border-indigo-600 hover:shadow-lg transition-all duration-200 hover:scale-105"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                
                    
                    <!-- Title Section -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-2">
                            <h1 class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-slate-900 to-gray-700 bg-clip-text text-transparent">
                                Kriteria {{ $kriteria->id }}
                            </h1>
                            @include('components.status-badge', ['status' => $kriteria->status])
                        </div>
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2">
                            Sub Kriteria {{ $kriteria->id }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
            <!-- Validation Sidebar -->
            <div class="xl:col-span-4 2xl:col-span-3">
                <div class="sticky top-6">
                    <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                       
                        <!-- Header -->
                        <div class="p-6" style="background: linear-gradient(to right, #832C94, #E8A344);">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-white">Validasi Kriteria</h3>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <div class="p-6">
                            <form method="POST" action="{{ route('validator.validasi.store', $kriteria->id) }}" class="space-y-6">
                                @csrf
           

                                <!-- Comment Section -->
                                <div class="space-y-3">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Komentar Validasi
                                    </label>
                                    <div class="relative">
                                        <textarea
                                            name="komentar"
                                            placeholder="Tambahkan komentar validasi Anda..."
                                            rows="5"
                                            class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 resize-none bg-gray-50/50 hover:bg-white focus:bg-white placeholder:text-gray-400"
                                        >{{ old('komentar') }}</textarea>
                                        <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                            <span id="char-count">0</span> karakter
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4">
                                    <button 
                                        type="submit"
                                        name="aksi"
                                        value="valid"
                                        class="group relative px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:ring-offset-2 transition-all duration-200 hover:scale-105"
                                    >
                                        <div class="flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Validasi
                                        </div>
                                    </button>
                                    
                                    <button 
                                        type="submit"
                                        name="aksi"
                                        value="revisi"
                                        class="group relative px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-red-600 rounded-xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:ring-offset-2 transition-all duration-200 hover:scale-105"
                                    >
                                        <div class="flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Minta Revisi
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PDF Viewer Section -->
            <div class="xl:col-span-8 2xl:col-span-9">
                <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <!-- PDF Viewer Header -->
                   
                            
            

                    <!-- PDF Viewer Content -->
                    <div class="pdf-viewer-wrapper">
                        @include('components.pdf-viewer', ['kriteria' => $kriteria, 'pdfUrl' => $pdfUrl ?? null])
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
/* PDF Viewer Enhanced Styling */
.pdf-viewer-wrapper {
    min-height: 70vh;
    background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
    position: relative;
    overflow: hidden;
}

.pdf-viewer-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, #d1d5db 50%, transparent 100%);
}

.pdf-viewer-wrapper iframe,
.pdf-viewer-wrapper embed,
.pdf-viewer-wrapper object {
    width: 100%;
    min-height: 70vh;
    border: none;
    background: white;
    box-shadow: inset 0 1px 3px 0 rgba(0, 0, 0, 0.05);
}

/* Character Counter Animation */
#char-count {
    transition: color 0.2s ease;
}

textarea:focus ~ div #char-count {
    color: #4f46e5;
}

/* Mobile Responsive Enhancements */
@media (max-width: 640px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .pdf-viewer-wrapper {
        min-height: 60vh;
    }
    
    .pdf-viewer-wrapper iframe,
    .pdf-viewer-wrapper embed,
    .pdf-viewer-wrapper object {
        min-height: 60vh;
    }
}

@media (max-width: 1024px) {
    .xl\:col-span-4 {
        margin-bottom: 1.5rem;
    }
    
    .sticky {
        position: relative;
    }
}

/* Enhanced Hover Effects */
button:hover {
    transform: translateY(-1px);
}

button:active {
    transform: translateY(0);
}

/* Custom Scrollbar */
.pdf-viewer-wrapper::-webkit-scrollbar {
    width: 6px;
}

.pdf-viewer-wrapper::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 3px;
}

.pdf-viewer-wrapper::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
    transition: background-color 0.2s ease;
}

.pdf-viewer-wrapper::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Loading Animation */
@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

.loading-shimmer {
    background: linear-gradient(90deg, #e5e7eb 25%, #f3f4f6 50%, #e5e7eb 75%);
    background-size: 1000px 100%;
    animation: shimmer 2s infinite;
}

/* Glass Effect Enhancement */
.bg-white\/80 {
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

.bg-white\/90 {
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
}

/* Form Focus States */
textarea:focus {
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    border-color: #4f46e5;
}

/* Button Press Animation */
button[type="submit"]:active {
    transform: scale(0.98);
}

/* Status Badge Positioning */
@media (max-width: 640px) {
    .status-badge {
        align-self: flex-start;
    }
}

/* Success/Error Message Animation */
@keyframes slideIn {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.bg-green-50, .bg-red-50 {
    animation: slideIn 0.3s ease-out;
}
</style>

<script>
// Character counter functionality
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.querySelector('textarea[name="komentar"]');
    const charCount = document.getElementById('char-count');
    
    if (textarea && charCount) {
        function updateCharCount() {
            const count = textarea.value.length;
            charCount.textContent = count;
            
            // Change color based on length
            if (count > 500) {
                charCount.style.color = '#f59e0b';
            } else if (count > 750) {
                charCount.style.color = '#ef4444';
            } else {
                charCount.style.color = '#9ca3af';
            }
        }
        
        textarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial count
    }
});

// Enhanced form submission with loading states
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[method="POST"]');
    const buttons = form?.querySelectorAll('button[type="submit"]');
    
    if (form && buttons) {
        form.addEventListener('submit', function() {
            buttons.forEach(button => {
                button.disabled = true;
                const originalContent = button.innerHTML;
                button.innerHTML = `
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </div>
                `;
                
                // Restore button after 10 seconds as fallback
                setTimeout(() => {
                    button.disabled = false;
                    button.innerHTML = originalContent;
                }, 10000);
            });
        });
    }
});

// Auto-hide success/error messages after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const messages = document.querySelectorAll('.bg-green-50, .bg-red-50');
    messages.forEach(message => {
        setTimeout(() => {
            message.style.transition = 'opacity 0.5s ease-out';
            message.style.opacity = '0';
            setTimeout(() => {
                message.remove();
            }, 500);
        }, 5000);
    });
});
</script>
@endsection