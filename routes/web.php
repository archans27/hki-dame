<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return view('welcome');});
// Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
Route::post('/gantiKepalaKeluarga', [\App\Http\Controllers\KeluargaController::class, 'gantiKepalaKeluarga']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
    Route::resources([
        //DATA MASTER
        'jemaat' => \App\Http\Controllers\JemaatController::class,
        'keluarga' => \App\Http\Controllers\KeluargaController::class,
        'detailkeluarga' => \App\Http\Controllers\DetailKeluargaController::class,
        'sektor' => \App\Http\Controllers\SektorController::class,
        'sintua' => \App\Http\Controllers\SintuaController::class,
        'user' => \App\Http\Controllers\UserController::class,
        //DATA TRANSAKSIONAL
        'baptisSidi' => \App\Http\Controllers\BaptisSidiController::class,
        'katekisasi' => \App\Http\Controllers\KatekisasiController::class,
        'jemaatBaru' => \App\Http\Controllers\JemaatBaruController::class,
        'jemaatLahir' => \App\Http\Controllers\JemaatLahirController::class,
        'ikatanJanji' => \App\Http\Controllers\PernikahanController::class,
        'pernikahan' => \App\Http\Controllers\PernikahanController::class,
        'pindah' => \App\Http\Controllers\PindahController::class,
        'meninggal' => \App\Http\Controllers\MeninggalController::class,
        'martupol' => \App\Http\Controllers\MartupolController::class,
    ]);
});
require __DIR__.'/auth.php';
