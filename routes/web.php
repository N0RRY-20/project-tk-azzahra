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
use App\Http\Controllers\Admin\ATPController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventLombaController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\RaportController;
use App\Http\Controllers\Admin\RekapAbsensiController;
use App\Http\Controllers\Admin\SupervisiRppController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\BukuKomunikasiController;
use App\Http\Controllers\EventController as ControllersEventController;
use App\Http\Controllers\Guru\AbsensiController;
use App\Http\Controllers\Guru\ATPController as GuruATPController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\SiswaController as GuruSiswaController;
use App\Http\Controllers\Guru\LaporanController;
use App\Http\Controllers\Guru\RpphController;
use App\Http\Controllers\Guru\RppmController;
use App\Http\Controllers\Orangtua\DashboardController as OrangtuaDashboardController;
use App\Http\Controllers\PendaftaranLombaController;
use App\Http\Controllers\ProfilController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Untuk Tamu / Guest)
|--------------------------------------------------------------------------
| Rute ini hanya bisa diakses oleh pengguna yang BELUM login.
*/

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

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

    // Rute untuk mengirim pesan di Buku Komunikasi
    Route::post('/komunikasi', [BukuKomunikasiController::class, 'store'])->name('komunikasi.store');

    // Rute untuk melihat daftar & detail event (bisa diakses semua peran)
    Route::get('/events', [ControllersEventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [ControllersEventController::class, 'show'])->name('events.show');

    // Rute untuk orang tua mendaftar & batal mendaftar lomba
    Route::post('/lomba/daftar', [PendaftaranLombaController::class, 'store'])->name('lomba.daftar');
    Route::delete('/lomba/batal', [PendaftaranLombaController::class, 'destroy'])->name('lomba.batal');

    // Rute untuk Profil & Pengaturan
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/data', [ProfilController::class, 'updateData'])->name('profil.update.data');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.update.password');
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
    Route::resource('kelas', KelasController::class)->parameters([
        'kelas' => 'kelas'
    ]);
    Route::resource('aspekPenilaian', AspekPenilaianController::class);

    // Rute untuk Rekap Absensi
    Route::get('/rekap-absensi/siswa', [RekapAbsensiController::class, 'rekapSiswa'])->name('absensi.siswa');

    // Rute CRUD untuk Manajemen Absensi Guru
    Route::resource('absensi-guru', AbsensiGuruController::class);
    // Rute CRUD untuk Manajemen Jadwal Kegiatan
    Route::resource('jadwal-kegiatan', JadwalController::class);

    // Rute CRUD untuk Manajemen Pengumuman & Event
    Route::resource('pengumuman', PengumumanController::class);

    // Rute CRUD untuk Manajemen Tagihan
    Route::resource('tagihan', TagihanController::class);
    // Rute untuk menampilkan form generate massal
    Route::get('/tagihan-massal/create', [TagihanController::class, 'createMassal'])->name('tagihan.createMassal');
    // Rute untuk memproses generate massal
    Route::post('/tagihan-massal', [TagihanController::class, 'storeMassal'])->name('tagihan.storeMassal');

    // Rute untuk memproses hapus massal
    Route::post('/tagihan/hapus-massal', [TagihanController::class, 'destroyMassal'])->name('tagihan.destroyMassal');

    // Rute khusus untuk menambah pembayaran pada tagihan tertentu
    Route::get('tagihan/{tagihan}/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('tagihan/{tagihan}/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');


    // Rute untuk Event utama
    Route::resource('events', EventController::class);

    // Rute untuk Lomba yang berada DI DALAM sebuah Event
    Route::resource('events.lomba', EventLombaController::class)->shallow();

    // Rute untuk menampilkan form generate raport
    Route::get('/raport', [RaportController::class, 'create'])->name('raport.create');
    // Rute untuk mencetak raport
    Route::post('/raport/cetak', [RaportController::class, 'cetak'])->name('raport.cetak');

    // Rute CRUD untuk Manajemen ATP
    Route::resource('atp', ATPController::class);
    // Rute untuk Supervisi RPP
    Route::get('/supervisi-rpp', [SupervisiRppController::class, 'index'])->name('supervisi-rpp.index');
    Route::get('/supervisi-rpp/{guru}', [SupervisiRppController::class, 'show'])->name('supervisi-rpp.show');
});


/*
|--------------------------------------------------------------------------
| Rute Khusus Guru
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
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

    // Rute untuk Manajemen RPP
    Route::resource('rppm', RppmController::class);
    Route::resource('rppm.rpph', RpphController::class)->shallow();


    // Rute untuk guru melihat ATP
    Route::get('/atp', [GuruATPController::class, 'index'])->name('atp.index');
});


/*
|--------------------------------------------------------------------------
| Rute Khusus Orang Tua
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'orangtua'])->prefix('orangtua')->name('orangtua.')->group(function () {
    Route::get('/dashboard', [OrangtuaDashboardController::class, 'index'])->name('dashboard');
});
