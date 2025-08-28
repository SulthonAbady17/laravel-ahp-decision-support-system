<?php

use App\Http\Controllers\Admin\AlternativeController;
use App\Http\Controllers\Admin\CriterionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PeriodCalculationController;
use App\Http\Controllers\Admin\PeriodConfigurationController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\ResultController as AdminResultController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Member\ComparisonController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\ResultController as MemberResultController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kita hanya mendefinisikan route untuk menampilkan view statis.
|
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Grup untuk semua route yang memerlukan login
Route::middleware('auth')->group(function () { // Ini akan kita aktifkan nanti
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Route untuk profil pengguna
    Route::get('/profile', fn() => view('profile.edit'))->name('profile.edit');

    // Dashboard umum yang akan mengarahkan berdasarkan role
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('member.dashboard');
    })->name('dashboard');

    // ==================
    // == ADMIN ROUTES ==
    // ==================
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD Kriteria
        Route::resource('criteria', CriterionController::class);

        // CRUD Alternatif
        Route::resource('alternatives', AlternativeController::class);

        // CRUD Periode
        Route::resource('periods', PeriodController::class);

        // CRUD User
        Route::resource('users', UserController::class);

        Route::get('periods/{period}/configure', [PeriodConfigurationController::class, 'edit'])->name('periods.configure');
        Route::put('periods/{period}/configure', [PeriodConfigurationController::class, 'update'])->name('periods.configure.update');

        Route::post('/periods/{period}/calculate', PeriodCalculationController::class)->name('periods.calculate');

        Route::get('/results/{period}', [AdminResultController::class, 'index'])->name('results');
    });

    // ==================
    // == MEMBER ROUTES ==
    // ==================
    Route::prefix('member')->name('member.')->group(function () {

        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');

        // Alur Perbandingan
        Route::get('/comparisons', [ComparisonController::class, 'create'])->name('comparisons.create');
        Route::post('/comparisons/criteria', [ComparisonController::class, 'storeCriteria'])->name('comparisons.criteria.store');

        // ROUTE BARU
        Route::get('/comparisons/alternatives', [ComparisonController::class, 'createAlternatives'])->name('comparisons.alternatives.create');
        Route::post('/comparisons/alternatives', [ComparisonController::class, 'storeAlternatives'])->name('comparisons.alternatives.store');
        Route::get('/comparisons/finalize', [ComparisonController::class, 'finalize'])->name('comparisons.finalize');

        Route::get('/complete', fn() => view('member.complete'))->name('complete');

        Route::get('/results', [MemberResultController::class, 'index'])->name('results');
    });
});
