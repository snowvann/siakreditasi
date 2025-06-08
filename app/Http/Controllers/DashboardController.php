<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kriteria;

class DashboardController extends Controller
{
    public function validatorDashboard()
    {
        $user = auth()->user();

        // Validasi jika bukan validator
        if ($user->role !== 'Validator') {
            abort(403, 'Unauthorized');
        }

        return view('validator.dashboard', compact('user'));
    }

    public function superAdminDashboard()
    {
        $user = auth()->user();

        // Validasi jika bukan SuperAdmin
        if ($user->role !== 'SuperAdmin') {
            abort(403, 'Unauthorized');
        }

        return view('superAdmin.dashboard', compact('user'));
    }

    public function index()
    {
        // Total pengguna
        $totalUsers = User::count();

        // Ambil data kriteria dan hitung progres berdasarkan jumlah submissions
        $kriteriaData = Kriteria::withCount('submissions')->get()->map(function ($kriteria) use ($totalUsers) {
            $progress = $totalUsers > 0 ? min(100, ($kriteria->submissions_count / $totalUsers) * 100) : 0;

            return [
                'id' => $kriteria->id,
                'nama' => $kriteria->nama,
                'progress' => round($progress, 2)
            ];
        });

        return view('dashboard', compact('kriteriaData', 'totalUsers'));
    }
}
