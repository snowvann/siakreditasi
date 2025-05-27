<header class="sticky top-0 z-10 border-b bg-white">
    <div class="container mx-auto flex h-16 items-center justify-between px-4">
        <!-- KIRI: Logo Polinema + JTI -->
        <a class="flex items-center gap-2">
            <img src="{{ asset('logo/logopolinema.png') }}" alt="Logo Polinema" class="h-10 w-auto">
            <img src="{{ asset('logo/logojti.png') }}" alt="Logo JTI" class="h-10 w-auto">
        </a>

        <!-- TENGAH: Navigasi -->
        <ul class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-700">
            <li>
                <a href="#" onclick="return false;" class="px-3 py-1 rounded-md bg-gray-300 text-gray-500 ">
                    Dashboard
                </a>
                
            </li>
            <li><span class="text-gray-400">||</span></li>
            <li>
                <!-- Ubah ke route Kriteria yang bener -->
                <a href="{{ route('dashboard') }}"
                class="px-3 py-1 rounded-md transition-all duration-200
                {{ request()->routeIs('dashboard') ? 'bg-[#191D6A] text-white' : 'hover:bg-gray-100' }}">
                    Kriteria
                </a>
            </li>
        </ul>

        <!-- KANAN: Notifikasi + Avatar -->
        <div class="flex items-center gap-4">
            <!-- Notifikasi -->
            <button class="inline-flex h-10 w-10 items-center justify-center rounded-md border hover:bg-accent">
                <!-- Icon bell -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                </svg>
            </button>

            <!-- Avatar Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="relative h-8 w-8 rounded-full overflow-hidden bg-muted">
                    @if(auth()->user()->avatar_path)
                        <img src="{{ asset(auth()->user()->avatar_path) }}" alt="User" class="object-cover w-full h-full">
                    @else
                        <div class="h-full w-full flex items-center justify-center bg-primary text-white font-medium">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                    @endif
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="p-4">
                        <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-muted-foreground">{{ auth()->user()->email }}</p>
                        <p class="text-xs text-muted-foreground">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                    <div class="border-t"></div>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Profil</a>
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Pengaturan</a>
                    <div class="border-t"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
