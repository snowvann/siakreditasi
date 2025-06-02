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
    public function index()
    {
        // Fetch total number of users
        $totalUsers = User::count();

        // Fetch criteria data (example with initial progress of 0)
        $criteria = Kriteria::all()->map(function ($criterion) use ($totalUsers) {
            // Assume submissions are tracked (e.g., via a submissions count or relationship)
            $submissions = $criterion->submissions()->count(); // Adjust based on your model relationship
            $progress = $totalUsers > 0 ? min(100, ($submissions / $totalUsers) * 100) : 0;

            return [
                'id' => $criterion->id,
                'description' => $criterion->description,
                'subCriteriaCount' => $criterion->subCriteriaCount ?? 5, // Default value
                'progress' => $progress, // Dynamic progress based on submissions
                'statuses' => ['Draft', 'Menunggu Validasi'], // Initial statuses
                'mainStatus' => 'Draft',
            ];
        })->toArray();

        // Provided static values
        $totalCriteria = 9;
        $submittedCriteria = 8;
        $relatedCriteria = 3;
        $validatedCriteria = 2;
        $totalMembers = 12;
        $overallProgress = 33;
        $statuses = [
            ['name' => 'Ditugaskan Kepada Saya'],
            ['name' => 'Menunggu Validasi'],
        ];

        return view('Kriteria', compact(
            'totalCriteria',
            'submittedCriteria',
            'relatedCriteria',
            'validatedCriteria',
            'totalMembers',
            'overallProgress',
            'statuses',
            'criteria'
        ));
    }
}
