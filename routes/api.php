<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SiswaApiController;
use App\Http\Controllers\Api\KelasApiController;
use App\Http\Controllers\Api\SemesterApiController;
use App\Http\Controllers\Api\MapelApiController;
use App\Http\Controllers\Api\TugasApiController; 
use App\Http\Controllers\Api\NilaiApiController; 
use App\Http\Controllers\Api\BeritaApiController;  
use App\Http\Controllers\Api\AuthApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthApiController::class, 'login']);

Route::post('/logout', [AuthApiController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::apiResource('siswa', SiswaApiController::class);
Route::get('/siswa/{id}/edit', [SiswaApiController::class, 'edit']);

Route::get('/kelas', [KelasApiController::class, 'index']);
Route::post('/kelas', [KelasApiController::class, 'store']);
Route::put('/kelas/{id}', [KelasApiController::class, 'update']);
Route::delete('/kelas/{id}', [KelasApiController::class, 'destroy']);

Route::get('/semester', [SemesterApiController::class, 'index']);
Route::post('/semester', [SemesterApiController::class, 'store']);
Route::put('/semester/{id}', [SemesterApiController::class, 'update']);
Route::delete('/semester/{id}', [SemesterApiController::class, 'destroy']);

Route::apiResource('mapel', MapelApiController::class);

Route::apiResource('tugas', TugasApiController::class);

Route::get('/nilai', [NilaiApiController::class, 'index']);
Route::post('/nilai', [NilaiApiController::class, 'store']);

Route::get('/berita', [BeritaApiController::class, 'index']);
Route::post('/berita', [BeritaApiController::class, 'store']);
Route::get('/berita/{id}', [BeritaApiController::class, 'show']);
Route::post('/berita/{id}', [BeritaApiController::class, 'update']);
Route::delete('/berita/{id}', [BeritaApiController::class, 'destroy']);