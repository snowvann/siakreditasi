<!-- Header -->
<header class="sticky top-0 z-10 border-b bg-white">
    <div class="container mx-auto flex h-16 items-center justify-between px-4">
        <!-- KIRI: Logo Polinema + JTI -->
        <a class="flex items-center gap-2">
            <img src="{{ asset('logo/logopolinema.png') }}" alt="Logo Polinema" class="h-10 w-auto">
            <img src="{{ asset('logo/logojti.png') }}" alt="Logo JTI" class="h-10 w-auto">
        </a>

        <!-- TENGAH: Navigasi -->
        <ul class="flex items-center gap-6 text-sm font-medium text-gray-700">
            <li>
                <a href="{{ route('validator.dashboard') }}"
                   class="px-3 py-1 rounded-md transition-all duration-200
                   {{ request()->routeIs('validator.kriteria') ? 'bg-[#191D6A] text-white' : 'hover:bg-gray-100' }}">
                    Dashboard
                </a>
            </li>
            <li><span class="text-gray-400">||</span></li>
            <li>
                <a href="{{ route('validator.dashboard') }}"
                   class="px-3 py-1 rounded-md transition-all duration-200
                   {{ request()->routeIs('validator.dashboard') ? 'bg-[#191D6A] text-white' : 'hover:bg-gray-100' }}">
                    Validasi Kriteria
                </a>
            </li>
        </ul>

        <!-- KANAN: Notifikasi + Avatar -->
        <div class="flex items-center gap-4">
            <!-- Notifikasi -->
            <button class="inline-flex h-10 w-10 items-center justify-center rounded-md border hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                </svg>
            </button>

            <!-- Dropdown Profil -->
            <div x-data="{ open: false }" class="relative">
                <!-- Button Avatar + Arrow -->
                <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                    <!-- Avatar -->
                    <div class="h-10 w-10 rounded-full overflow-hidden border-2 border-gray-300">
                        @if(auth()->user()->avatar_path)
                            <img src="{{ asset(auth()->user()->avatar_path) }}" alt="User" class="object-cover w-full h-full">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-gray-700 text-white font-medium">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    <!-- Panah ke bawah -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-black" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.084l3.71-3.855a.75.75 0 111.08 1.04l-4.25 4.417a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false" x-transition
                     class="absolute right-0 mt-2 w-64 bg-gray-100 rounded-lg shadow-md z-50">
                    <!-- Header -->
                    <div class="px-4 pt-4 pb-2">
                        <p class="text-sm font-bold text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                    <hr class="my-2 border-gray-300">

                    <!-- Menu Items -->
                    <ul class="text-sm text-gray-700">
                        <li>
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 hover:bg-gray-200 transition rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Profil
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-200 transition rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.25 4.5l.625 1.875M4.5 11.25l1.875.625m13.125 0l-1.875.625m-6.25 6.25l.625 1.875M8.25 8.25l7.5 7.5m0-7.5l-7.5 7.5" />
                                </svg>
                                Pengaturan
                            </a>
                        </li>
                    </ul>

                    <hr class="my-2 border-gray-300">

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-200 transition rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6-4v8" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>