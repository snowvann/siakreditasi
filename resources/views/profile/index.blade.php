@extends('layouts.app')

@include('components.dashboard-header')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-gradient-to-r from-indigo-100 to-indigo-200 rounded-xl shadow-lg p-8 flex w-[700px] relative">
       
        <!-- Bagian Kiri: Foto + Label -->
    <div class="w-1/3 flex flex-col items-center justify-center">
        <span class="text-lg font-semibold mb-4">My Profil</span>
        
        <!-- Lingkaran foto -->
        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-white shadow-md">
            @if ($user->photo)
                <img src="{{ asset('storage/photos/' . $user->photo) }}" alt="Foto"
                     class="w-full h-full object-cover">
            @else
                <img src="{{ asset('images/default-user.png') }}" alt="Default"
                     class="w-full h-full object-cover">
            @endif
        </div>
    </div>
       
        <!-- Tombol Close (opsional) -->
        <a href="{{ route('dashboardUtama') }}" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">&times;</a>

        <!-- Kanan: Data -->
        <div class="w-2/3 pl-8">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Nama</label>
                <div class="mt-1 px-3 py-2 bg-white rounded-md shadow-sm">{{ $user->name }}</div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Username</label>
                <div class="mt-1 px-3 py-2 bg-white rounded-md shadow-sm">{{ $user->username }}</div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Role</label>
                <div class="mt-1 px-3 py-2 bg-white rounded-md shadow-sm">{{ ucfirst($user->role) }}</div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Password</label>
                <div class="mt-1 px-3 py-2 bg-white rounded-md shadow-sm">••••••••</div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('edit') }}"
                   class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-6 py-2 rounded-md">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
