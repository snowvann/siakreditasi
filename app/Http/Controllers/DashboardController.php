<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Isian;

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

    public function index(Request $request)
{
    $query = $request->input('q');

    $kriteriaQuery = Kriteria::with(['subkriteria'])->withCount([
        'subkriteria as totalSubkriteria',
        'subkriteria as completedSubkriteria' => function ($q) {
            $q->whereHas('isian'); // sesuaikan relasi jika perlu
        }
    ]);

    if ($query) {
        $kriteriaQuery->where(function ($q2) use ($query) {
            $q2->where('nama_kriteria', 'like', '%' . $query . '%')
                ->orWhere('status', 'like', '%' . $query . '%');
        });
    }

    $kriteriaList = $kriteriaQuery->get();

    $kriteriaData = [];
    $totalProgressSum = 0;
    $totalKriteriaCount = $kriteriaList->count();

    foreach ($kriteriaList as $kriteria) {
        $subKriteriaWithProgress = $kriteria->subkriteria->map(function ($subKriteria) {
            $hasIsian = Isian::where('subkriteria_id', $subKriteria->id)
                ->where('akreditasi_id', 1) // sesuaikan dengan akreditasi aktif
                ->whereNotNull('nilai')
                ->exists();

            $subKriteria->has_isian = $hasIsian;
            return $subKriteria;
        });

        $totalSubkriteria = $kriteria->subkriteria->count();
        $completedSubkriteria = $subKriteriaWithProgress->where('has_isian', true)->count();
        $progressPercentage = $totalSubkriteria > 0 ? round(($completedSubkriteria / $totalSubkriteria) * 100) : 0;

        $totalProgressSum += $progressPercentage;

        $kriteriaData[] = [
            'id' => $kriteria->id,
            'nama_kriteria' => $kriteria->nama_kriteria,
            'progressPercentage' => $progressPercentage,
            'totalSubkriteria' => $totalSubkriteria,
            'completedSubkriteria' => $completedSubkriteria,
        ];
    }

    $averageProgress = $totalKriteriaCount > 0 ? round($totalProgressSum / $totalKriteriaCount) : 0;
    $totalUsers = User::count();

    return view('dashboard', [
        'kriteria' => $kriteriaData,
        'averageProgress' => $averageProgress,
        'totalUsers' => $totalUsers,
    ]);
}

}