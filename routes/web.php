<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KriteriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardUtamaController;
use App\Http\Controllers\DashboardController;

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
