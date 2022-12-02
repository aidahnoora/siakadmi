<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'fetch']);
    Route::post('user', [AuthController::class, 'updateProfile']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('/index', [SiswaController::class, 'index']);
    Route::get('/jadwal-siswa', [SiswaController::class, 'get_jadwal']);
    Route::get('/absensi-siswa', [SiswaController::class, 'get_absensi']);
    Route::get('/nilai-siswa', [SiswaController::class, 'get_nilai']);
});
