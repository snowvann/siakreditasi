@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50">
  <!-- Header -->
  <header class="bg-white border-b border-gray-200">
    <div class="container mx-auto px-6 py-4">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-8">
          <h1 class="text-2xl font-bold text-gray-900">Admin</h1>
          <nav class="flex items-center gap-8">
            <x-button :variant="$currentView === 'overview' ? 'default' : 'ghost'" 
                      onclick="window.location.href='{{ route('admin.dashboard') }}'">
              Dashboard
            </x-button>
            <!-- Other navigation items -->
          </nav>
        </div>
        <!-- User profile section -->
      </div>
    </div>
  </header>

  <main class="container mx-auto px-6 py-8">
    @if($currentView === 'overview')
      <x-admin-overview />
    @elseif($currentView === 'users')
      <x-user-management />
    @elseif($currentView === 'criteria')
      <x-criteria-management />
    @endif
  </main>
</div>
@endsection