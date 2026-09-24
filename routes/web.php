<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\UtamaController;


// =======================
// PUBLIC
// =======================

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/', [UtamaController::class, 'index'])
    ->name('utama.index');

Route::get('/utama/{id}', [UtamaController::class, 'show'])
    ->name('utama.show');


// =======================
// ADMIN
// =======================

Route::middleware('role:admin')->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard-admin');

    // Hanya Admin
    Route::resource('kelas', KelasController::class);

    Route::resource('berita', BeritaController::class);

    Route::resource('mapel', MapelController::class)
        ->except(['create', 'edit', 'show']);

    Route::resource('semester', SemesterController::class)
        ->except(['create', 'edit', 'show']);
});


// =======================
// ADMIN + GURU
// =======================

Route::middleware('role:admin,guru')->group(function () {

    // Siswa
    Route::resource('siswa', SiswaController::class);

    // Tugas
    Route::resource('tugas', TugasController::class);

    // Nilai
    Route::get('/nilai', [NilaiController::class, 'index'])
        ->name('nilai.index');

    Route::post('/nilai', [NilaiController::class, 'store'])
        ->name('nilai.store');
});


// =======================
// GURU
// =======================

Route::middleware('role:guru')->group(function () {

    Route::get('/guru/dashboard', function () {
        return view('guru/dashboard-guru');
    })->name('guru.dashboard');

});



// Route::get('/admin/dashboard', function () {
//     if (session('user') && session('user')->role === 'admin') {
//         return app(DashboardController::class)->index();
//     }
//     return redirect('/login');
// })->name('admin.dashboard-admin');

// Route::get('/guru/dashboard', function () {
//     if (session('user') && session('user')->role === 'guru') {
//         return view('guru/dashboard-guru');
//     }
//     return redirect('/login');
// })->name('guru.dashboard');