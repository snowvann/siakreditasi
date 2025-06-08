<header class="sticky top-0 z-50 backdrop-blur-lg bg-white/80 border-b border-gray-200/50 shadow-xl">
    <!-- Gradient background overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 via-purple-500/5 to-pink-500/5"></div>
    
    <div class="container mx-auto relative">
        <div class="flex h-20 items-center justify-between px-4 md:px-6">
            <!-- Enhanced Logo Section -->
            <a class="flex items-center gap-4 group">
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/60 backdrop-blur-sm border border-white/30 shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                    <img src="{{ asset('logo/logopolinema.png') }}" alt="Logo Polinema" class="h-10 w-auto">
                    <div class="w-px h-8 bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>
                    <img src="{{ asset('logo/logojti.png') }}" alt="Logo JTI" class="h-10 w-auto">
                </div>
                <div class="hidden lg:block">
                    <div class="text-xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                        SIAKREDITASI
                    </div>
                    <div class="text-sm text-gray-500 font-medium">
                        Sistem Akreditasi D4 SIB
                    </div>
                </div>
            </a>

            <!-- Right Side: Enhanced Avatar + Dropdown -->
            <div class="flex items-center gap-4">
                <!-- Notification Bell (Optional) -->
                <div class="hidden md:flex items-center">
                    <button class="relative p-2 rounded-xl bg-white/60 backdrop-blur-sm border border-white/30 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group">
                        <svg class="w-6 h-6 text-gray-600 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5v5zm-10-4V7a7 7 0 1114 0v6l2 2H3l2-2z"/>
                        </svg>
                        <!-- Notification dot -->
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full border-2 border-white animate-pulse"></div>
                    </button>
                </div>

                <!-- Enhanced Avatar & Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" 
                            class="flex items-center gap-3 p-2 rounded-2xl bg-white/60 backdrop-blur-sm border border-white/30 shadow-lg hover:shadow-xl focus:outline-none transition-all duration-300 hover:scale-105 group">
                        <!-- Enhanced Avatar -->
                        <div class="relative">
                            <div class="h-12 w-12 rounded-2xl overflow-hidden border-2 border-gradient-to-r from-indigo-500 to-purple-500 shadow-lg">
                                @if(auth()->user()->photo)
                                    <img src="{{ asset('storage/photos/' . auth()->user()->photo) }}"
                                         alt="User Photo"
                                         class="object-cover w-full h-full">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold text-lg">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <!-- Online status indicator -->
                        </div>

                        <!-- User Info (Hidden on mobile) -->
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-semibold text-gray-800 leading-tight">
                                {{ Str::limit(auth()->user()->name, 15) }}
                            </div>
                            <div class="text-xs text-gray-500 capitalize font-medium">
                                {{ auth()->user()->role }}
                            </div>
                        </div>

                        <!-- Enhanced Arrow -->
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-indigo-600 transition-all duration-200 transform group-hover:rotate-180" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.084l3.71-3.855a.75.75 0 111.08 1.04l-4.25 4.417a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Enhanced Dropdown -->
                    <div
                        x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 transform translate-y-2"
                        x-transition:enter-end="opacity-100 scale-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 transform translate-y-2"
                        class="absolute right-0 mt-4 w-72 bg-white/90 backdrop-blur-lg border border-gray-200/50 rounded-3xl shadow-2xl z-50 overflow-hidden"
                    >
                        <!-- Enhanced Header Info -->
                        <div class="relative p-6 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
                            <div class="absolute inset-0 bg-black/10"></div>
                            <div class="relative flex items-center gap-4">
                                <div class="h-16 w-16 rounded-2xl overflow-hidden border-3 border-white/30 shadow-xl">
                                    @if(auth()->user()->photo)
                                        <img src="{{ asset('storage/photos/' . auth()->user()->photo) }}"
                                             alt="User Photo"
                                             class="object-cover w-full h-full">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center bg-white/20 text-white font-bold text-xl">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="text-white">
                                    <p class="text-lg font-bold leading-tight">{{ auth()->user()->name }}</p>
                                    <p class="text-white/80 capitalize font-medium">{{ auth()->user()->role }}</p>
                              
                                </div>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <div class="p-2">
                            <!-- Profile Section -->
                            <div class="space-y-1">
                                <a href="{{ route('profile') }}" 
                                   class="flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-200 rounded-2xl group">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800">Profil Saya</div>
                                        <div class="text-xs text-gray-500">Kelola informasi pribadi</div>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400 ml-auto group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                                <!-- Settings (Optional) -->
                                
                            </div>

                            <hr class="my-3 border-gray-200">

                            <!-- Enhanced Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-red-50 hover:to-rose-50 transition-all duration-200 rounded-2xl group">
                                    <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-rose-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6-4v8"/>
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <div class="font-semibold text-red-600">Keluar</div>
                                        <div class="text-xs text-red-500">Logout dari sistem</div>
                                    </div>
                                    <svg class="w-4 h-4 text-red-400 ml-auto group-hover:text-red-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom border gradient -->
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-indigo-500/30 to-transparent"></div>
</header>

<style>
    /* Enhanced dropdown animations */
    [x-cloak] { display: none !important; }
    
    /* Custom gradient borders */
    .border-gradient-to-r {
        border-image: linear-gradient(to right, #6366f1, #8b5cf6) 1;
    }
    
    /* Smooth hover effects */
    .group:hover .group-hover\:rotate-180 {
        transform: rotate(180deg);
    }
    
    /* Custom backdrop blur for better browser support */
    .backdrop-blur-lg {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
    
    /* Enhanced shadow effects */
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    /* Smooth animations */
    * {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>