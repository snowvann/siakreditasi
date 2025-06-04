<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:anggota,validator'
        ]);

        $user = User::where('username', $credentials['username'])
                    ->where('role', ucfirst($credentials['role']))
                    ->first();

<<<<<<< HEAD
            return redirect()->intended('/dashboardUtama');
=======
        info($user);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->withInput();
>>>>>>> 7daecf35a65ff673a70509281a5b2b713b8c94f4
        }

        Auth::login($user);

        if ($user->role === 'Validator') {
            return redirect()->route('validator.dashboard');
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
