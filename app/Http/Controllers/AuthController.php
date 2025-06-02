<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $role = $request->role;

        // Autentikasi dengan tambahan role
        if (Auth::attempt(array_merge($credentials, ['role' => $role]))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'login_error' => 'Username, password, atau role salah.',
        ])->withInput();
    }
}
