<?php

use App\Http\Controllers\Admin\AspekPenilaianController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\models\data;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\Admin;

//METHOD : GET
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->name('register');

// Auth
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');




// // METHOD : POST
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::post('/', [LoginController::class, 'auth'])->name('login.check');

// logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth', 'admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('guru', GuruController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('kelas', KelasController::class)->parameters([
        'kelas' => 'kelas'
    ]);
    Route::resource('aspekPenilaian', AspekPenilaianController::class);
});
