<?php

// Import semua Controller yang dibutuhkan
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\Admin\AbsensiGuruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\AspekPenilaianController;
use App\Http\Controllers\Admin\RekapAbsensiController;
use App\Http\Controllers\Guru\AbsensiController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\SiswaController as GuruSiswaController;
use App\Http\Controllers\Guru\LaporanController;
use App\Http\Controllers\Orangtua\DashboardController as OrangtuaDashboardController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Untuk Tamu / Guest)
|--------------------------------------------------------------------------
| Rute ini hanya bisa diakses oleh pengguna yang BELUM login.
*/
Route::middleware('guest')->group(function () {
    Route::get('/', function () { return redirect()->route('login'); });
    
    // Rute untuk Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth'])->name('login.check');

    // Rute untuk Aktivasi Akun Orang Tua
    Route::get('/aktivasi', [ActivationController::class, 'create'])->name('aktivasi.create');
    Route::post('/aktivasi', [ActivationController::class, 'store'])->name('aktivasi.store');
});


/*
|--------------------------------------------------------------------------
| Rute yang Membutuhkan Login (Semua Peran)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Dashboard fallback jika peran tidak cocok (seharusnya tidak terjadi)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| Rute Khusus Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('guru', GuruController::class);
    Route::resource('siswa', AdminSiswaController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('aspekPenilaian', AspekPenilaianController::class);

     // Rute untuk Rekap Absensi
     Route::get('/rekap-absensi/siswa', [RekapAbsensiController::class, 'rekapSiswa'])->name('absensi.siswa');
    
      // Rute CRUD untuk Manajemen Absensi Guru
    Route::resource('absensi-guru', AbsensiGuruController::class);
});


/*
|--------------------------------------------------------------------------
| Rute Khusus Guru
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','guru'])->prefix('guru')->name('guru.')->group(function(){
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/siswa/{siswa}', [GuruSiswaController::class, 'show'])->name('siswa.show');
    
    // Rute kustom untuk form 'create' laporan
    Route::get('/laporan/create/{siswa}', [LaporanController::class, 'create'])->name('laporan.create');
    
    // Gunakan resource untuk sisanya (store, edit, update, destroy)
    Route::resource('laporan', LaporanController::class)->except(['index', 'show', 'create']);

     // Rute untuk Absensi Siswa
     Route::get('/absensi/riwayat', [AbsensiController::class, 'index'])->name('absensi.index'); 
     Route::get('/absensi', [AbsensiController::class, 'create'])->name('absensi.create');
     Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
});


/*
|--------------------------------------------------------------------------
| Rute Khusus Orang Tua
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'orangtua'])->prefix('orangtua')->name('orangtua.')->group(function(){
    Route::get('/dashboard', [OrangtuaDashboardController::class, 'index'])->name('dashboard');
});