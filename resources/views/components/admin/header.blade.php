<header class="flex h-16 shrink-0 items-center gap-2 border-b bg-white px-4">
  <button @click="sidebarOpen = !sidebarOpen" class="-ml-1">
    <!-- Menu icon -->
  </button>

  <div class="flex flex-1 items-center justify-between">
    <div>
      <h1 class="text-xl font-semibold">{{ $viewTitles[$currentView] ?? 'Dashboard' }}</h1>
    </div>

    <div class="flex items-center gap-4">
      <div class="relative w-64">
        <x-icon.search class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
        <x-input type="search" placeholder="Cari..." class="pl-10" />
      </div>
      <!-- Notification bell -->
    </div>
  </div>
</header>