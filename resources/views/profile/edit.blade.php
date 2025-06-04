@extends('layouts.app')

@include('components.dashboard-header')

@section('content')
<style>
    .profile-card {
        width: 500px;
        margin: auto;
        margin-top: 10%;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        padding: 20px;
    }
    .profile-card table {
        width: 100%;
    }
    .profile-card td {
        padding: 12px 8px;
        vertical-align: middle;
    }
    .profile-card td:first-child {
        width: 30%;
        font-weight: bold;
    }
    .profile-card td:nth-child(2) {
        width: 5%;
    }
    .profile-photo {
        display: block;
        margin: 10px auto;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 2px solid #ccc;
        transition: 0.3s ease-in-out;
    }
</style>

<div class="profile-card">
    <form action="{{ route('update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h5 class="p-3 border-bottom font-bold text-2xl">Edit Profil</h5>

        {{-- Tampilkan Foto Profil --}}
        @if ($user->avatar_path)
            <img id="preview-image" src="{{ asset('storage/' . $user->avatar_path) }}" class="profile-photo" alt="Foto Profil">
        @else
            <img id="preview-image" src="{{ asset('default-user.png') }}" class="profile-photo" alt="Foto Default">
        @endif

        {{-- Input Upload Foto --}}
        <div class="text-center mb-3">
            <input id="photo-input" type="file" name="photo" accept="image/*" class="form-control form-control-sm">
        </div>

        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="name" value="{{ $user->name }}" required class="form-control"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" value="{{ $user->username }}" required class="form-control"></td>
            </tr>
            <tr>
                <td>Role</td>
                <td>:</td>
                <td>{{ $user->role }}</td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td>********</td>
            </tr>
            <tr>
                <td colspan="3" align="right" class="pe-3 pt-2 pb-3">
                <button type="submit"
                    class="px-5 py-2 rounded-md bg-[#28a745] text-white font-bold text-sm shadow-sm hover:bg-[#218838] transition">
                    Save
                </button>
            </td>

            </tr>
        </table>
    </form>
</div>

<script>
    document.getElementById('photo-input').addEventListener('change', function(event) {
        const image = document.getElementById('preview-image');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
