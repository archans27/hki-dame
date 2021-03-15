<?php

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

Route::get('/jemaat/{hint}', 'App\Http\Controllers\Api\JemaatController@index');
Route::get('/pekerjaan/{hint}', 'App\Http\Controllers\Api\JemaatController@pekerjaan');
Route::get('/keluarga/{hint}', 'App\Http\Controllers\Api\JemaatController@kepalaKeluarga');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
