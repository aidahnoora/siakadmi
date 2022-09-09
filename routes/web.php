<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MapelController;

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

Auth::routes();

Route::middleware(['auth', 'checkrole:admin,guru,siswa,kepsek'])->group(function (){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

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
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswa/edit');
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa/update');
    Route::get('/siswa/delete/{id}', [SiswaController::class, 'destroy'])->name('siswa/delete');

    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel');
    Route::get('/mapel/add', [MapelController::class, 'create'])->name('mapel/add');
    Route::post('/mapel/save', [MapelController::class, 'store'])->name('mapel/save');
    Route::get('/mapel/edit/{id}', [MapelController::class, 'edit'])->name('mapel/edit');
    Route::put('/mapel/update/{id}', [MapelController::class, 'update'])->name('mapel/update');
    Route::get('/mapel/delete/{id}', [MapelController::class, 'destroy'])->name('mapel/delete');

});

Route::middleware(['auth', 'checkrole:admin,guru'])->group(function (){



});

Route::middleware(['auth', 'checkrole:admin,siswa'])->group(function (){



});

Route::middleware(['auth', 'checkrole:admin,kepsek'])->group(function (){



});
