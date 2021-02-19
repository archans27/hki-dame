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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function() {
    Route::resources([
        'jemaat' => \App\Http\Controllers\JemaatController::class,
        'keluarga' => \App\Http\Controllers\KeluargaController::class,
        'detailkeluarga' => \App\Http\Controllers\DetailKeluargaController::class,
        'sektor' => \App\Http\Controllers\SektorController::class
    ]);
});
require __DIR__.'/auth.php';
