<?php

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


// Route untuk otentikasi (bisa dipisah ke auth.php nanti)
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/logout', fn() => redirect()->route('welcome'))->name('logout');


// Grup untuk semua route yang memerlukan login
// Route::middleware('auth')->group(function () { // Ini akan kita aktifkan nanti

// Route untuk profil pengguna
Route::get('/profile', fn() => view('profile.edit'))->name('profile.edit');

// Dashboard umum yang akan mengarahkan berdasarkan role
Route::get('/dashboard', function () {
    // Untuk sekarang, kita arahkan ke member dashboard sebagai default
    return view('member.dashboard');
})->name('dashboard');

// ==================
// == ADMIN ROUTES ==
// ==================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('/results', fn() => view('admin.results'))->name('results');

    // CRUD Kriteria
    Route::get('/criteria', fn() => view('admin.criteria.index'))->name('criteria.index');
    Route::get('/criteria/create', fn() => view('admin.criteria.create'))->name('criteria.create');
    Route::get('/criteria/{id}/edit', fn() => view('admin.criteria.edit'))->name('criteria.edit');

    // CRUD Alternatif
    Route::get('/alternatives', fn() => view('admin.alternatives.index'))->name('alternatives.index');
    Route::get('/alternatives/create', fn() => view('admin.alternatives.create'))->name('alternatives.create');
    Route::get('/alternatives/{id}/edit', fn() => view('admin.alternatives.edit'))->name('alternatives.edit');

    // CRUD Periode
    Route::get('/periods', fn() => view('admin.periods.index'))->name('periods.index');
    Route::get('/periods/create', fn() => view('admin.periods.create'))->name('periods.create');
    Route::get('/periods/{id}/edit', fn() => view('admin.periods.edit'))->name('periods.edit');
    Route::get('/periods/{id}/configure', fn() => view('admin.periods.configure'))->name('periods.configure');

    // CRUD User
    Route::get('/users', fn() => view('admin.users.index'))->name('users.index');
    Route::get('/users/create', fn() => view('admin.users.create'))->name('users.create');
    Route::get('/users/{id}/edit', fn() => view('admin.users.edit'))->name('users.edit');
});

// ==================
// == MEMBER ROUTES ==
// ==================
Route::prefix('member')->name('member.')->group(function () {

    Route::get('/dashboard', fn() => view('member.dashboard'))->name('dashboard');
    Route::get('/complete', fn() => view('member.complete'))->name('complete');
    Route::get('/results', fn() => view('member.results'))->name('results');

    // Proses Perbandingan
    Route::get('/comparisons/criteria', fn() => view('member.comparisons.criteria'))->name('comparisons.criteria');
    Route::get('/comparisons/alternatives', fn() => view('member.comparisons.alternatives'))->name('comparisons.alternatives');
});

// }); // Penutup untuk middleware('auth')
