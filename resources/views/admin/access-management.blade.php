@extends('layouts.admin')

@section('content')
<div class="space-y-6">
  <!-- Header Actions -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h2 class="text-2xl font-bold">Pengaturan Akses</h2>
      <p class="text-gray-600">Kelola hak akses user terhadap kriteria akreditasi</p>
    </div>

    <x-dialog>
      <x-slot name="trigger">
        <x-button>
          <x-icon.plus class="w-4 h-4 mr-2" />
          Tambah Akses
        </x-button>
      </x-slot>
      <x-slot name="title">Tambah Hak Akses</x-slot>
      <x-slot name="description">Berikan hak akses user terhadap kriteria tertentu.</x-slot>
      <x-access-form />
    </x-dialog>
  </div>

  <x-tabs default="by-user">
    <x-tabs.list>
      <x-tabs.trigger value="by-user">Berdasarkan User</x-tabs.trigger>
      <x-tabs.trigger value="by-criteria">Berdasarkan Kriteria</x-tabs.trigger>
      <x-tabs.trigger value="all-access">Semua Akses</x-tabs.trigger>
    </x-tabs.list>

    <!-- Tab contents would go here -->
  </x-tabs>
</div>
@endsection