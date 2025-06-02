<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function showLoginForm()
{
    return view('auth.login');
}

   public function login(Request $request)
{
    $credentials = $request->only('username', 'password');
    $user = User::where('username', $credentials['username'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role === 'Validator') {
            return redirect()->route('validator-dashboard');
        } else if ($user->role === 'Anggota') {
            return redirect()->route('dashboard');
        } else {
            return redirect('/'); // fallback
        }
    }

    

    return back()->withErrors(['login_error' => 'Username atau password salah.']);
}
}
