<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\User;


class ProfileController extends Controller
{
    // Tampilkan profil
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    // Tampilkan form edit
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Proses update profil
    public function update(Request $request)
{
    $user = Auth::user();

    $user->name = $request->name;
    $user->username = $request->username;

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/photos', $filename);
        $user->photo = $filename;
    }

    $user->save();

    return redirect()->route('index')->with('success', 'Profil berhasil diperbarui.');
}

}
