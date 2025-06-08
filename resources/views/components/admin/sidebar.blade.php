<aside class="sidebar" x-data="{ open: false }">
  <div class="sidebar-header p-4">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
        <x-icon.bar-chart-3 class="w-6 h-6 text-white" />
      </div>
      <div>
        <h2 class="font-bold text-lg">Admin Panel</h2>
        <p class="text-sm text-gray-600">Sistem Akreditasi</p>
      </div>
    </div>
  </div>

  <div class="sidebar-content">
    <div class="sidebar-group">
      <div class="sidebar-group-label">Menu Utama</div>
      <div class="sidebar-group-content">
        <ul class="sidebar-menu">
          @foreach($menuItems as $item)
            <li class="sidebar-menu-item">
              <a href="{{ route('admin.' . $item['view']) }}" 
                 class="sidebar-menu-button {{ $currentView === $item['view'] ? 'active' : '' }}">
                <x-dynamic-component :component="'icon.' . strtolower($item['icon'])" class="w-4 h-4" />
                <span>{{ $item['title'] }}</span>
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <!-- Footer with user profile -->
</aside>