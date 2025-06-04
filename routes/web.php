<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KriteriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUtamaController;
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

// Public Routes
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kriteria Routes
    Route::prefix('kriteria')->group(function () {
        Route::get('/{id}/unduh-pdf', [KriteriaController::class, 'unduhPdf'])->name('kriteria.unduh-pdf');
        Route::get('/{id}', [KriteriaController::class, 'show'])->name('kriteria.show');
        Route::post('/{kriteria}/sub-kriteria/{subKriteria}/isian', [KriteriaController::class, 'simpanIsian'])
            ->name('kriteria.subkriteria.simpanIsian');
        Route::get('/{kriteria}/sub-kriteria/{subKriteria}', [KriteriaController::class, 'showSubKriteria'])
            ->name('kriteria.subkriteria.show');
    });

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Validator Routes
Route::middleware(['auth', 'role:validator'])->prefix('validator')->group(function () {
    Route::get('/validator/kriteria/{id}/preview-pdf', [ValidatorKriteriaController::class, 'previewPdf'])->name('validator.kriteria.preview');
    Route::get('/dashboard-validator', [ValidatorKriteriaController::class, 'index'])->name('validator.dashboard');
    Route::get('/kriteria', [ValidatorKriteriaController::class, 'list'])->name('validator.kriteria');
    Route::get('/kriteria/{id}', [ValidatorKriteriaController::class, 'show'])->name('validator.kriteria.show');
    Route::post('/kriteria/{id}/validate', [ValidatorKriteriaController::class, 'validatekriteria'])
        ->name('validator.kriteria.validate');
});

// Member Routes (if needed)
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/member/dashboard', [DashboardController::class, 'memberDashboard'])->name('member.dashboard');
});
Route::get('/dashboardUtama', function () {
    return view('dashboardUtama');
})->name('dashboard.utama');

Route::get('/dashboardUtama', [DashboardUtamaController::class, 'index'])->name('dashboardUtama');

require __DIR__.'/auth.php';
