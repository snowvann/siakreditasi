<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KriteriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardUtamaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ValidatorKriteriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/validator', function () {
    // Statistik dashboard
    $pendingValidation = 10;
    $needsRevision = 5;
    $validated = 25;
    $totalApplications = 40;
    $rejectedApplications = 0;
    
    // UI state variables
    $activeTab = 'dashboard';
    $sortBy = 'newest';
    $filterStatus = 'all';
    $searchQuery = '';
    
    // Data untuk kriteria (ini yang menyebabkan error)
    $filteredKriteria = [
        (object)['id' => 1, 'name' => 'Kriteria 1', 'status' => 'pending'],
        (object)['id' => 2, 'name' => 'Kriteria 2', 'status' => 'approved'],
        (object)['id' => 3, 'name' => 'Kriteria 3', 'status' => 'revision'],
    ]; // atau bisa kosong: []
    
    // Jika menggunakan database, ganti dengan:
    // $filteredKriteria = YourModel::where('status', 'active')->get();
    
    // Sort options
    $sortOptions = [
        'newest' => 'Terbaru',
        'oldest' => 'Terlama', 
        'priority-high' => 'Prioritas Tinggi',
        'priority-low' => 'Prioritas Rendah'
    ];
    
    return view('validator-dashboard', compact(
        'pendingValidation', 'needsRevision', 'validated',
        'totalApplications', 'rejectedApplications',
        'activeTab', 'sortBy', 'filterStatus', 'searchQuery',
        'filteredKriteria', 'sortOptions'
    ));
})->middleware(['auth', 'verified'])->name('validator-dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/kriteria/{id}/unduh-pdf', [KriteriaController::class, 'unduhPdf'])
    ->name('kriteria.unduh-pdf');

    Route::post('/kriteria/{kriteria}/sub-kriteria/{subKriteria}/isian', [KriteriaController::class, 'simpanIsian'])
    ->name('kriteria.subkriteria.simpanIsian');

    Route::get('/kriteria/{id}', [KriteriaController::class, 'show'])->name('kriteria.show');
    Route::get('/kriteria/{kriteria}/sub-kriteria/{subKriteria}', [KriteriaController::class, 'showSubKriteria'])
        ->name('kriteria.subkriteria.show');
});

Route::get('/dashboardUtama', function () {
    return view('dashboardUtama');
})->name('dashboard.utama');

Route::get('/dashboardUtama', [DashboardUtamaController::class, 'index'])->name('dashboardUtama');

require __DIR__.'/auth.php';
