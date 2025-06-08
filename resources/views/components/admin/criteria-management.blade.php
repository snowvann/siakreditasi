@extends('layouts.admin')

@section('content')
<div class="space-y-6">
  <!-- Header Actions -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h2 class="text-2xl font-bold">Manajemen Kriteria</h2>
      <p class="text-gray-600">Kelola kriteria dan sub-kriteria akreditasi</p>
    </div>

    <x-dialog>
      <x-slot name="trigger">
        <x-button>
          <x-icon.plus class="w-4 h-4 mr-2" />
          Tambah Kriteria
        </x-button>
      </x-slot>
      <x-slot name="title">Tambah Kriteria Baru</x-slot>
      <x-slot name="description">Masukkan informasi kriteria baru yang akan ditambahkan.</x-slot>
      <x-criteria-form />
    </x-dialog>
  </div>

  <!-- Search -->
  <x-card>
    <x-card.content class="p-6">
      <div class="relative">
        <x-icon.search class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
        <x-input placeholder="Cari kriteria atau sub-kriteria..." class="pl-10" />
      </div>
    </x-card.content>
  </x-card>

  <!-- Criteria List -->
  <div class="space-y-4">
    @foreach($criteria as $criterion)
      <x-criteria-card :criteria="$criterion" />
    @endforeach
  </div>
</div>
@endsection