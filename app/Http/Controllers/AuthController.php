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
            'role' => 'required|in:anggota,validator,SuperAdmin'
        ]);

        $user = User::where('username', $credentials['username'])
            ->where('role', ucfirst($credentials['role']))
            ->first();

            if (!$user) {
                Log::warning('User tidak ditemukan dengan username dan role yang diberikan', $credentials);
            
                return back()->withErrors([
                    'username' => 'Username atau password salah.',
                ])->withInput();
            }
            
            // Ini aman, karena $user tidak null
            Log::info('Pengguna ditemukan: ', ['user' => $user]);
            Log::info('Pemeriksaan kata sandi: ', [
                'input' => $credentials['password'],
                'hashed' => $user->password,
                'result' => Hash::check($credentials['password'], $user->password),
            ]);
            
            if (!Hash::check($credentials['password'], $user->password)) {
                return back()->withErrors([
                    'username' => 'Username atau password salah.',
                ])->withInput();
            }
            

        Auth::login($user);

        if (ucfirst($user->role) === 'Validator') {
            return redirect()->route('validator.dashboard');
        } elseif (ucfirst($user->role) === 'SuperAdmin') {
            return redirect()->route('superadmin.dashboard'); // Perbaiki ke lowercase
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
