@extends('layouts.app')

@include('components.validator-header')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">
                Edit Profile
            </h1>
        </div>

        <!-- Main Edit Form Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <!-- Decorative Header -->
            <div class="h-24 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-2 -left-4 w-16 h-16 bg-white/10 rounded-full"></div>
                
                <!-- Back Button -->
                <a href="{{ route('profile.validator.index') }}" 
                   class="absolute top-4 left-4 w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white hover:scale-110 transition-all duration-300 backdrop-blur-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>

            <form action="{{ route('validator.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <!-- Profile Picture Section -->
                <div class="flex flex-col items-center mb-8 -mt-12">
                    <div class="relative group">
                        <!-- Profile Picture -->
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-2xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center group-hover:scale-105 transition-all duration-300">
                            @if ($user->avatar_path)
                                <img id="preview-image" src="{{ asset('storage/' . $user->avatar_path) }}" 
                                     class="w-full h-full object-cover" alt="Foto Profil">
                            @else
                                <img id="preview-image" src="{{ asset('default-user.png') }}" 
                                     class="w-full h-full object-cover" alt="Foto Default"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Upload Button Overlay -->
                        <label for="photo-input" class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 cursor-pointer">
                            <div class="text-center text-white">
                                <svg class="w-8 h-8 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-xs font-medium">Change Photo</span>
                            </div>
                        </label>

                        <!-- Camera Icon -->
                        <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center border-3 border-white shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Hidden File Input -->
                    <input id="photo-input" type="file" name="photo" accept="image/*" class="hidden">
                    
                    <!-- Upload Instructions -->
                    <p class="text-sm text-gray-500 mt-4 text-center">
                        Click on the image to upload a new photo<br>
                        <span class="text-xs">Supported formats: JPG, PNG, GIF (Max: 2MB)</span>
                    </p>
                </div>

                <!-- Form Fields Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Name Field -->
                    <div class="group col-span-1 md:col-span-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            Full Name
                        </label>
                        <div class="relative">
                            <input type="text" name="name" value="{{ $user->name }}" required
                                   class="w-full px-4 py-3 bg-gradient-to-r from-gray-50 to-blue-50 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 text-gray-900 font-medium group-hover:border-indigo-300"
                                   placeholder="Enter your full name">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Username Field -->
                    <div class="group">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                            Username
                        </label>
                        <div class="relative">
                            <input type="text" name="username" value="{{ $user->username }}" required
                                   class="w-full px-4 py-3 bg-gradient-to-r from-gray-50 to-purple-50 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 text-gray-900 font-medium group-hover:border-purple-300"
                                   placeholder="Enter your username">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Role Field (Read-only) -->
                    <div class="group">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Role
                        </label>
                        <div class="relative">
                            <div class="w-full px-4 py-3 bg-gradient-to-r from-gray-50 to-green-50 border border-gray-200 rounded-xl shadow-sm text-gray-500 font-medium flex items-center justify-between">
                                <span>{{ ucfirst($user->role) }}</span>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-xs">Read Only</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-2xl p-6 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-yellow-800">Password Security</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Your current password is: <span class="font-mono tracking-wider">••••••••</span></p>
                                <p class="mt-1">To change your password, please contact your system administrator.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-gray-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                    
                    <button type="submit"
                            class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <svg class="w-5 h-5 mr-2 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="relative z-10">Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('photo-input').addEventListener('change', function(event) {
        const image = document.getElementById('preview-image');
        const file = event.target.files[0];

        if (file) {
            // Validate file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size should not exceed 2MB');
                this.value = '';
                return;
            }

            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Please select a valid image file');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
                image.style.display = 'block';
                
                // Hide fallback div if it exists
                const fallbackDiv = image.nextElementSibling;
                if (fallbackDiv) {
                    fallbackDiv.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const nameInput = document.querySelector('input[name="name"]');
        const usernameInput = document.querySelector('input[name="username"]');
        
        if (nameInput.value.trim().length < 2) {
            e.preventDefault();
            alert('Name must be at least 2 characters long');
            nameInput.focus();
            return;
        }
        
        if (usernameInput.value.trim().length < 3) {
            e.preventDefault();
            alert('Username must be at least 3 characters long');
            usernameInput.focus();
            return;
        }
    });

    // Add smooth focus effects
    document.querySelectorAll('input[type="text"]').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-indigo-500');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-indigo-500');
        });
    });
</script>

<style>
    .border-3 {
        border-width: 3px;
    }
    
    /* Custom file input styling */
    input[type="file"]::-webkit-file-upload-button {
        visibility: hidden;
    }
    
    input[type="file"]::before {
        content: 'Choose Photo';
        display: inline-block;
        background: linear-gradient(to right, #6366f1, #8b5cf6);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        outline: none;
        white-space: nowrap;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
    }
    
    input[type="file"]:hover::before {
        background: linear-gradient(to right, #4f46e5, #7c3aed);
    }
    
    /* Loading animation for form submission */
    .form-loading {
        opacity: 0.7;
        pointer-events: none;
    }
    
    /* Smooth transitions for all interactive elements */
    * {
        transition: all 0.3s ease;
    }
</style>
@endsection