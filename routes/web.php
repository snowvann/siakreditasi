<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile1Controller;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardUtamaController;
use App\Http\Controllers\ValidatorKriteriaController;

// Public Routes
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');     // Halaman view profil
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');     // Halaman edit profil
        Route::put('/update', [ProfileController::class, 'update'])->name('update'); // Simpan perubahan
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    });

    // Kriteria
    Route::prefix('kriteria')->group(function () {
        Route::get('/{id}/unduh-pdf', [KriteriaController::class, 'unduhPdf'])->name('kriteria.unduh-pdf');
        Route::get('/{id}', [KriteriaController::class, 'show'])->name('kriteria.show');
        Route::get('/{kriteria}/sub-kriteria/{subKriteria}', [KriteriaController::class, 'showSubKriteria'])
            ->name('kriteria.subkriteria.show');
        Route::post('/{kriteria}/sub-kriteria/{subKriteria}/isian', [KriteriaController::class, 'simpanIsian'])
            ->name('kriteria.subkriteria.simpanIsian');
    });
});

// Validator Routes
Route::middleware(['auth', 'role:validator'])->prefix('validator')->group(function () {
    Route::get('/kriteria/{id}/preview-pdf', [ValidatorKriteriaController::class, 'previewPdf'])->name('validator.kriteria.preview');
    Route::get('/dashboard-validator', [ValidatorKriteriaController::class, 'index'])->name('validator.dashboard');
    Route::get('/kriteria', [ValidatorKriteriaController::class, 'list'])->name('validator.kriteria');
    Route::get('/kriteria/{id}', [ValidatorKriteriaController::class, 'show'])->name('validator.kriteria.show');
    Route::post('/kriteria/{id}/validate', [ValidatorKriteriaController::class, 'validatekriteria'])
        ->name('validator.kriteria.validate');
});

// Member Routes
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/member/dashboard', [DashboardController::class, 'memberDashboard'])->name('member.dashboard');
});

// Dashboard Utama
Route::get('/dashboardUtama', [DashboardUtamaController::class, 'index'])->name('dashboardUtama');

// Tambahan jika perlu tampilan statis
Route::get('/dashboardUtama', function () {
    return view('dashboardUtama');
})->name('dashboard.utama');

require __DIR__.'/auth.php';
