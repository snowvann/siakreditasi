<?php

use App\Http\Controllers\ProfileAnggotaController;
use App\Http\Controllers\ProfileValidatorController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\KriteriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUtamaController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ValidatorKriteriaController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\SubKriteriaController;

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

    // Profile
    Route::prefix('profile')->group(function () {
        Route::prefix('anggota')->group(function () {
            Route::get('/', [ProfileAnggotaController::class, 'index'])->name('anggota'); // ← ini yang penting!
            Route::get('/edit', [ProfileAnggotaController::class, 'edit'])->name('anggota.edit');
            Route::put('/update', [ProfileAnggotaController::class, 'update'])->name('anggota.update');
            Route::get('/anggota', [ProfileAnggotaController::class, 'index'])->name('anggota.index');
            Route::get('/profile/anggota', [ProfileAnggotaController::class, 'index'])->name('profile.anggota.index');
        });
        Route::prefix('validator')->group(function () {
            Route::get('/', [ProfileValidatorController::class, 'index'])->name('validator'); // ← ini yang penting!
            Route::get('/edit', [ProfileValidatorController::class, 'edit'])->name('validator.edit');
            Route::put('/update', [ProfileValidatorController::class, 'update'])->name('validator.update');
            Route::get('/validator', [ProfileValidatorController::class, 'index'])->name('validator.index');
            Route::get('/profile/validator', [ProfileValidatorController::class, 'index'])->name('profile.validator.index');
        });
        Route::prefix('admin')->group(function () {
            Route::get('/', [ProfileAdminController::class, 'index'])->name('admin'); // ← ini yang penting!
            Route::get('/edit', [ProfileAdminController::class, 'edit'])->name('admin.edit');
            Route::put('/update', [ProfileAdminController::class, 'update'])->name('admin.update');
            Route::get('/admin', [ProfileAdminController::class, 'index'])->name('admin.index');
            Route::get('/profile/admin', [ProfileAdminController::class, 'index'])->name('profile.admin.index');
        });
    });
    // Kriteria Routes
    Route::prefix('kriteria')->group(function () {
        Route::get('/manage', [KriteriaController::class, 'manage'])->name('criteria.manage');
        Route::get('/{id}/unduh-pdf', [KriteriaController::class, 'unduhPdf'])->name('kriteria.unduh-pdf');
        Route::get('/{id}', [KriteriaController::class, 'show'])->name('kriteria.show');
        Route::post('/store', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        Route::put('/{id}/update', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('/{id}/delete', [KriteriaController::class, 'destroy'])->name('criteria.destroy');

        // Sub-Kriteria Routes
        Route::post('/subkriteria/store', [SubKriteriaController::class, 'store'])->name('subkriteria.store');
        Route::get('/subkriteria/{id}/edit', [SubKriteriaController::class, 'edit'])->name('subkriteria.edit');
        Route::put('/subkriteria/{id}/update', [SubKriteriaController::class, 'update'])->name('subkriteria.update');
        Route::delete('/subkriteria/{id}/delete', [SubKriteriaController::class, 'destroy'])->name('subcriteria.destroy');

        Route::post('/{kriteria}/sub-kriteria/{subKriteria}/isian', [KriteriaController::class, 'simpanIsian'])
            ->name('kriteria.subkriteria.simpanIsian');
        Route::get('/{kriteria}/sub-kriteria/{subKriteria}', [KriteriaController::class, 'showSubKriteria'])
            ->name('kriteria.subkriteria.show');
    });

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Notifikasi
Route::get('/api/notifikasi', [NotifikasiController::class, 'index']);
Route::post('/api/notifikasi/{id}/baca', [NotifikasiController::class, 'tandaiDibaca']);
Route::post('/api/notifikasi/baca-semua', [NotifikasiController::class, 'tandaiSemuaDibaca']);
Route::delete('/api/notifikasi/{id}', [NotifikasiController::class, 'hapus']);

// Validator Routes
Route::middleware(['auth', 'role:validator'])->prefix('validator')->group(function () {
    Route::post('/validator/kriteria/{id}/validasi', [ValidatorKriteriaController::class, 'validasiStore'])->name('validator.validasi.store');
    Route::get('/validator/kriteria/{id}/preview-pdf', [ValidatorKriteriaController::class, 'previewPdf'])->name('validator.kriteria.preview');
    Route::get('/kriteria', [ValidatorKriteriaController::class, 'list'])->name('validator.kriteria');
    Route::get('/kriteria/{id}', [ValidatorKriteriaController::class, 'show'])->name('validator.kriteria.show');
    Route::post('/kriteria/{id}/validate', [ValidatorKriteriaController::class, 'validatekriteria'])
        ->name('validator.kriteria.validate');
});

Route::get('/validator/dashboard-validator', [ValidatorKriteriaController::class, 'index'])->name('validator.dashboard');

// SuperAdmin Routes
Route::middleware(['auth', 'role:SuperAdmin'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/superadmin/kriteria', [SuperAdminController::class, 'getCriteria'])->name('superadmin.criteria');
    Route::get('/riwayat-isian', [SuperAdminController::class, 'riwayatIsian'])->name('superadmin.riwayat.isian');
    Route::get('/kriteria/{id}', [SuperAdminController::class, 'show'])->name('superadmin.kriteria.show');
    Route::post('/kriteria/{id}/validasi', [SuperAdminController::class, 'validasiStore'])->name('superadmin.validasi.store');
    Route::get('/kriteria/{id}/preview-pdf', [SuperAdminController::class, 'previewPdf'])->name('superadmin.kriteria.preview');
    Route::post('/kriteria/{id}/validate', [SuperAdminController::class, 'validateKriteria'])->name('superadmin.kriteria.validate');

    Route::prefix('superadmin/manage')->middleware(['auth', 'superadmin'])->group(function () {
        Route::get('/users', [SuperAdminController::class, 'index'])->name('superadmin.manage.users');
        Route::post('/user/store', [SuperAdminController::class, 'storeUser'])->name('superadmin.store.user');
        Route::get('/user/{id}/data', [SuperAdminController::class, 'getUserData'])->name('superadmin.user.data');
        Route::put('/user/{id}', [SuperAdminController::class, 'updateUser'])->name('superadmin.update.user');
        Route::get('/superadmin/manage/user/{id}/access', [SuperAdminController::class, 'getUserAccess'])->name('superadmin.user.access');
        Route::post('/superadmin/manage/user/{id}/access', [SuperAdminController::class, 'updateUserAccess'])->name('superadmin.user.access.update');
        Route::delete('superadmin/manage/user/{id}', [SuperAdminController::class, 'destroy'])->name('superadmin.delete.user');
    });

    // Untuk menampilkan list user
    Route::get('/manage/users', [SuperAdminController::class, 'manageUsers'])->name('superadmin.manage.users');

    // Kriteria Management Routes
    Route::get('/manage/user/{id}/data', [SuperAdminController::class, 'getUserData'])->name('superadmin.manage.user.data');
    Route::get('/manage/kriteria', [SuperAdminController::class, 'manageKriteria'])->name('superadmin.manage.kriteria');
    Route::get('/manage/kriteria/{id}', [SuperAdminController::class, 'manageKriteriaDetail'])->name('superadmin.manage.kriteria.detail');
    Route::put('/manage/kriteria/{id}', [SuperAdminController::class, 'updateKriteria'])->name('superadmin.update.kriteria');
    Route::post('/manage/user/store', [SuperAdminController::class, 'storeUser'])->name('superadmin.store.user');
    Route::put('/manage/user/{id}', [SuperAdminController::class, 'updateUser'])->name('superadmin.update.user');

    // Access Management Routes
    Route::get('/manage/access', [SuperAdminController::class, 'manageAccess'])->name('superadmin.manage.access');
});

// Member Routes (if needed)
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/member/dashboard', [DashboardController::class, 'memberDashboard'])->name('member.dashboard');
});

Route::get('/dashboardUtama', [DashboardUtamaController::class, 'index'])->name('dashboardUtama');

require __DIR__ . '/auth.php';
