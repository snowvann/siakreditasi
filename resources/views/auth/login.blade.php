@extends('layouts.app')

@section('content')
<style>
  body, html {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
</style>
<div class="flex h-screen relative">
  <!-- Back Button -->
  <div class="absolute top-4 left-4 z-10">
    <a href="{{ route('landing') }}" 
       class="text-white px-4 py-2 rounded-lg shadow-md transition duration-200 flex items-center gap-2"
       style="background-color: #4B5CAD;" 
       onmouseover="this.style.backgroundColor='#3E4D8F'" 
       onmouseout="this.style.backgroundColor='#4B5CAD'"> 
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      Kembali 
    </a>
  </div>
  
  <!-- Left Side -->
  <div class="flex-1 bg-cover bg-center bg-no-repeat text-white flex justify-center items-center text-left p-10 font-bold text-4xl bg-blend-overlay bg-black bg-opacity-40 md:flex hidden" 
       style="background-image: url('{{ asset('images/as.jpg') }}');">
    <div>SISTEM AKREDITASI <br> D4 SISTEM <br>INFORMASI BISNIS</div>
  </div>
  
  <!-- Right Side -->
  <div class="flex-1 flex justify-center items-center" style="background: linear-gradient(to bottom right, #77419C, #587CAA, #AFCAED);">
    <div class="rounded-3xl p-10 w-full max-w-md shadow-xl text-center" style="background-color: #FFFFFF;">
      <div class="flex justify-center items-center gap-4 mb-4">
        <img src="{{ asset('images/logoPolinema.png') }}" alt="Logo Polinema" class="h-20">
        <img src="{{ asset('images/logoJTI.png') }}" alt="Logo JTI" class="h-20">
      </div>
      <h5 class="mb-2 font-semibold text-lg">SELAMAT DATANG !</h5>
      <p class="mb-8 text-gray-600 text-sm">Masukan username dan password anda</p>
      
      @if ($errors->has('login_error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ $errors->first('login_error') }}
      </div>
    @endif
    
    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        @foreach ($errors->all() as $error)
          <div class="mb-2 last:mb-0">{{ $error }}</div>
        @endforeach
      </div>
    @endif
    
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif
    
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif
      
      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-4 text-left">
          <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username :</label>
          <input type="text" 
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                 style="background-color: #D0E2F3;"
                 id="username" 
                 name="username" 
                 required>
        </div>
        
        <div class="mb-4 text-left">
          <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role :</label>
          <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                  style="background-color: #D0E2F3;"
                  id="role" 
                  name="role" 
                  required>
            <option selected disabled>Pilih Role</option>
            <option value="SuperAdmin">SuperAdmin</option>
            <option value="anggota">Anggota</option>
            <option value="validator">Validator</option>
          </select>
        </div>
        
        <div class="mb-6 text-left">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password :</label>
          <input type="password" 
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                 style="background-color: #D0E2F3;"
                 id="password" 
                 name="password" 
                 required>
        </div>
        
        <button type="submit" 
                class="w-full text-white font-bold py-2 px-4 rounded-lg transition duration-200"
                style="background-color: #656ED3;"
                onmouseover="this.style.backgroundColor='#4B5CAD'"
                onmouseout="this.style.backgroundColor='#656ED3'">
          Masuk
        </button>
      </form>
    </div>
  </div>
</div>
@endsection