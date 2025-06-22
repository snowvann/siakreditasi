<header class="sticky top-0 z-50 backdrop-blur-md bg-white/90 border-b border-gray-200/50 shadow-sm">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 sm:h-18 items-center justify-between">
            <!-- KIRI: Logo Section -->
            <div class="flex items-center gap-3 sm:gap-4">
                <!-- Logo Container -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <img src="{{ asset('logo/logopolinema.png') }}" 
                         alt="Logo Polinema" 
                         class="h-8 sm:h-10 w-auto transition-all duration-200 hover:scale-105">
                    <img src="{{ asset('logo/logojti.png') }}" 
                         alt="Logo JTI" 
                         class="h-8 sm:h-10 w-auto transition-all duration-200 hover:scale-105">
                </div>
                
                    <!-- Brand Text -->
                <div class="hidden sm:block border-l border-gray-300 pl-3 sm:pl-4">
                    <h1 class="text-lg sm:text-xl font-bold bg-gradient-to-r from-[#95A0E8] to-[#7548BE] bg-clip-text text-transparent tracking-tight">
                        SIAKREDITASI
                    </h1>
                    <p class="text-xs sm:text-sm text-gray-600 font-medium -mt-1">
                        Sistem Akreditasi D4 SIB
                    </p>
                </div>
                
                <!-- Mobile Brand Text -->
                <div class="block sm:hidden">
                    <h1 class="text-sm font-bold bg-gradient-to-r from-[#95A0E8] to-[#7548BE] bg-clip-text text-transparent">SIAKREDITASI</h1>
                    <p class="text-xs text-gray-600 -mt-0.5">Sistem Akreditasi D4 SIB</p>
                </div>
            </div>

            <!-- KANAN: User Section -->
            <div class="flex items-center gap-2 sm:gap-4">
                
                

                <!-- Dropdown Profil -->
                <div x-data="{ open: false }" class="relative">
                    <!-- Button Avatar + Arrow -->
                    <button @click="open = !open" 
                            class="flex items-center gap-2 sm:gap-3 px-2 py-1 rounded-lg hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                        <!-- Avatar -->
                        <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-full overflow-hidden border-2 border-gray-200 shadow-sm ring-2 ring-white">
                            @if(auth()->user()->photo)
                                <img src="{{ asset('storage/photos/' . auth()->user()->photo) }}" 
                                     alt="User Photo" 
                                     class="object-cover w-full h-full">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600 text-white font-semibold text-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>

                        <!-- User Info (Hidden on Mobile) -->
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-semibold text-gray-900 leading-tight">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 leading-tight">
                                {{ ucfirst(auth()->user()->role) }}
                            </p>
                        </div>

                        <!-- Chevron -->
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="w-4 h-4 text-gray-500 transition-transform duration-200"
                             :class="{ 'rotate-180': open }"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.084l3.71-3.855a.75.75 0 111.08 1.04l-4.25 4.417a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                         class="absolute right-0 mt-3 w-72 sm:w-80 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden z-50">
                        
                        <!-- Header -->
                        <div class="px-4 sm:px-6 py-4 bg-gradient-to-r from-blue-50 to-purple-50 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="h-12 w-12 rounded-full overflow-hidden border-2 border-white shadow-sm">
                                    @if(auth()->user()->photo)
                                        <img src="{{ asset('storage/photos/' . auth()->user()->photo) }}" 
                                             alt="User Photo" 
                                             class="object-cover w-full h-full">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600 text-white font-semibold">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-600">{{ ucfirst(auth()->user()->role) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-2">
                            <a href="{{ route('validator') }}" 
                               class="flex items-center px-4 sm:px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150 group">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 group-hover:bg-blue-100 transition-colors duration-150 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Profil Saya</p>
                                    <p class="text-xs text-gray-500">Kelola informasi profil</p>
                                </div>
                            </a>

                            <!-- Divider -->
                            <div class="mx-4 sm:mx-6 my-2 border-t border-gray-100"></div>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center px-4 sm:px-6 py-3 text-red-600 hover:bg-red-50 transition-colors duration-150 group">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-red-100 group-hover:bg-red-200 transition-colors duration-150 mr-3">
                                        <!-- Ikon baru di sini -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M10 17L15 12L10 7V10H3V14H10V17Z" />
                                        <path d="M19 3H11C10.45 3 10 3.45 10 4V7H12V5H18V19H12V17H10V20C10 20.55 10.45 21 11 21H19C19.55 21 20 20.55 20 20V4C20 3.45 19.55 3 19 3Z" />
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-sm font-medium">Keluar</p>
                                        <p class="text-xs text-red-500">Logout dari sistem</p>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>