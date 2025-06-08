@extends('layouts.validator')

@section('content')
<div class="min-h-screen bg-gray-50">
  <!-- Header -->
  <header class="bg-white border-b border-gray-200">
    <!-- Header content -->
  </header>

  <main class="container mx-auto px-4 py-6">
    <!-- Back Button and Title -->
    <div class="flex items-center justify-between mb-6">
      <div class="flex items-center gap-4">
        <x-button variant="ghost" size="sm" onclick="window.history.back()">
          <x-icon.arrow-left class="w-4 h-4" />
        </x-button>
        <div>
          <h1 class="text-2xl font-bold flex items-center gap-3">
            Kriteria {{ $criteria->id }}: {{ $criteria->name }}
            <x-status-badge :status="$criteria->status" />
          </h1>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
      <!-- Left Sidebar with validation form -->
      <div class="lg:col-span-1 space-y-4">
        <x-validation-form :criteria="$criteria" />
      </div>

      <!-- Main Content with PDF viewer -->
      <div class="lg:col-span-3">
        <x-pdf-viewer :criteria="$criteria" />
      </div>
    </div>
  </main>
</div>
@endsection