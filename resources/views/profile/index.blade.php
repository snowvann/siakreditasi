@extends('layouts.app')

@include('components.dashboard-header')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">
               Profil Saya
            </h1>
            <p class="text-gray-600">Manage your personal information and preferences</p>
        </div>

        <!-- Main Profile Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 overflow-hidden hover:shadow-3xl transition-all duration-500">
            <!-- Decorative Header -->
            <div class="h-32 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-2 -left-4 w-16 h-16 bg-white/10 rounded-full"></div>
                
                <!-- Close Button -->
                <a href="{{ route('dashboard') }}" 
                   class="absolute top-4 right-4 w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white hover:scale-110 transition-all duration-300 backdrop-blur-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </div>

            <div class="relative px-8 pb-8">
                <!-- Profile Picture Section -->
                <div class="flex flex-col lg:flex-row -mt-16 mb-8">
                    <div class="flex flex-col items-center lg:items-start mb-6 lg:mb-0">
                        <!-- Profile Picture with Advanced Styling -->
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-2xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center group-hover:scale-105 transition-all duration-300">
                                @if ($user->photo && Storage::disk('public')->exists('photos/' . $user->photo))
                                    <img src="{{ Storage::url('photos/' . $user->photo) }}" 
                                         alt="Foto {{ $user->name }}"
                                         class="w-full h-full object-cover"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                @endif
                                
                                <!-- Fallback Profile Picture -->
                                <div class="w-full h-full flex items-center justify-center {{ ($user->photo && Storage::disk('public')->exists('photos/' . $user->photo)) ? 'hidden' : 'flex' }}">
                                    @if(file_exists(public_path('images/default-user.png')))
                                        <img src="{{ asset('images/default-user.png') }}" 
                                             alt="Default User"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Online Status Indicator -->
        
                        </div>

                        <!-- User Name & Role -->
                        <div class="text-center lg:text-left mt-4">
                            <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $user->name }}</h2>
                            <div class="flex items-center justify-center lg:justify-start">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-800 border border-indigo-200">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                                    </svg>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Name Field -->
                    <div class="group">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            Full Name
                        </label>
                        <div class="relative">
                            <div class="px-4 py-3 bg-gradient-to-r from-gray-50 to-blue-50 border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 group-hover:border-indigo-300">
                                <span class="text-gray-900 font-medium">{{ $user->name }}</span>
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
                            <div class="px-4 py-3 bg-gradient-to-r from-gray-50 to-purple-50 border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 group-hover:border-purple-300">
                                <span class="text-gray-900 font-medium">{{ $user->username }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Role Field -->
                    <div class="group">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Role
                        </label>
                        <div class="relative">
                            <div class="px-4 py-3 bg-gradient-to-r from-gray-50 to-green-50 border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 group-hover:border-green-300">
                                <span class="text-gray-900 font-medium">{{ ucfirst($user->role) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="group">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            Password
                        </label>
                        <div class="relative">
                            <div class="px-4 py-3 bg-gradient-to-r from-gray-50 to-red-50 border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 group-hover:border-red-300">
                                <span class="text-gray-900 font-medium tracking-widest">••••••••</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center sm:justify-end">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-gray-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                    
                    <a href="{{ route('edit') }}"
                       class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <svg class="w-5 h-5 mr-2 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span class="relative z-10">Edit Profile</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .shadow-3xl {
        box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
    }
    
    .border-3 {
        border-width: 3px;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
</style>
@endsection