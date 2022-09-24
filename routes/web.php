<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\IdentitasSekolahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NilaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/detailsiswa', function () {
    return view('pages.nilai.detail_nilai');
});

Auth::routes();

Route::middleware(['auth', 'checkrole:admin,guru,siswa,kepsek'])->group(function (){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profil', [HomeController::class, 'show'])->name('profil');
    Route::get('/profil/edit/{id}', [HomeController::class, 'edit'])->name('profil/edit');
    Route::put('/profil/update/{id}', [HomeController::class, 'update'])->name('profil/update');

    Route::get('/guru', [GuruController::class, 'index'])->name('guru');
    Route::get('/guru/add', [GuruController::class, 'create'])->name('guru/add');
    Route::post('/guru/save', [GuruController::class, 'store'])->name('guru/save');
    Route::get('/guru/edit/{id}', [GuruController::class, 'edit'])->name('guru/edit');
    Route::put('/guru/update/{id}', [GuruController::class, 'update'])->name('guru/update');
    Route::get('/guru/delete/{id}', [GuruController::class, 'destroy'])->name('guru/delete');

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/add', [KelasController::class, 'create'])->name('kelas/add');
    Route::post('/kelas/save', [KelasController::class, 'store'])->name('kelas/save');
    Route::get('/kelas/edit/{id}', [KelasController::class, 'edit'])->name('kelas/edit');
    Route::put('/kelas/update/{id}', [KelasController::class, 'update'])->name('kelas/update');
    Route::get('/kelas/delete/{id}', [KelasController::class, 'destroy'])->name('kelas/delete');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/siswa/add', [SiswaController::class, 'create'])->name('siswa/add');
    Route::post('/siswa/save', [SiswaController::class, 'store'])->name('siswa/save');
    Route::get('/siswa/detail/{id}', [SiswaController::class, 'show'])->name('siswa/detail');
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswa/edit');
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa/update');
    Route::get('/siswa/delete/{id}', [SiswaController::class, 'destroy'])->name('siswa/delete');

    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel');
    Route::get('/mapel/add', [MapelController::class, 'create'])->name('mapel/add');
    Route::post('/mapel/save', [MapelController::class, 'store'])->name('mapel/save');
    Route::get('/mapel/edit/{id}', [MapelController::class, 'edit'])->name('mapel/edit');
    Route::put('/mapel/update/{id}', [MapelController::class, 'update'])->name('mapel/update');
    Route::get('/mapel/delete/{id}', [MapelController::class, 'destroy'])->name('mapel/delete');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/add', [UserController::class, 'create'])->name('user/add');
    Route::post('/user/save', [UserController::class, 'store'])->name('user/save');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user/edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user/update');
    Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user/delete');

    Route::get('/sekolah', [IdentitasSekolahController::class, 'index'])->name('sekolah');
    Route::get('/sekolah/edit/{id}', [IdentitasSekolahController::class, 'edit'])->name('sekolah/edit');
    Route::put('/sekolah/update/{id}', [IdentitasSekolahController::class, 'update'])->name('sekolah/update');

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
    Route::post('/absensi/save', [AbsensiController::class, 'store'])->name('absensi/save');
    Route::get('/absensi/siswa/{id}', [AbsensiController::class, 'show'])->name('absensi/siswa');
    Route::get('/absensi/siswa/tanggal/{id}', [AbsensiController::class, 'absensi'])->name('absensi/siswa/tanggal');
    Route::get('/absensi/edit/{id}', [AbsensiController::class, 'edit'])->name('absensi/edit');
    Route::put('/absensi/update/{id}', [AbsensiController::class, 'update'])->name('absensi/update');
    Route::get('/absensi/delete/{id}', [AbsensiController::class, 'destroy'])->name('absensi/delete');

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::post('/jadwal/save', [JadwalController::class, 'store'])->name('jadwal/save');
    Route::get('/jadwal/detail/{id}', [JadwalController::class, 'show'])->name('jadwal/detail');
    Route::get('/jadwal/edit/{id}', [JadwalController::class, 'edit'])->name('jadwal/edit');
    Route::put('/jadwal/update/{id}', [JadwalController::class, 'update'])->name('jadwal/update');
    Route::get('/jadwal/delete/{id}', [JadwalController::class, 'destroy'])->name('jadwal/delete');

    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
    Route::post('/nilai/save', [NilaiController::class, 'store'])->name('nilai/save');
    Route::get('/nilai/siswa/{id}', [NilaiController::class, 'show'])->name('nilai/siswa');
    Route::get('/nilai/siswa/mapel/{id}', [NilaiController::class, 'nilai'])->name('nilai/siswa/mapel');
    Route::get('/nilai/edit/{id}', [NilaiController::class, 'edit'])->name('nilai/edit');
    Route::put('/nilai/update/{id}', [NilaiController::class, 'update'])->name('nilai/update');
    Route::get('/nilai/delete/{id}', [NilaiController::class, 'destroy'])->name('nilai/delete');

});

Route::middleware(['auth', 'checkrole:admin,guru'])->group(function (){



});

Route::middleware(['auth', 'checkrole:admin,siswa'])->group(function (){



});

Route::middleware(['auth', 'checkrole:admin,kepsek'])->group(function (){



});
