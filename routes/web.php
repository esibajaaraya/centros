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

Route::get('/menu', 'App\Http\Controllers\JuegoController@menu')->name('menu');
Route::post('/iniciar', 'App\Http\Controllers\JuegoController@iniciar')->name('iniciar');
Route::get('/tirar/{juego_id}', 'App\Http\Controllers\JuegoController@tirar')->name('tirar');
Route::get('/jugar/{turno_id}/{apuesta}', 'App\Http\Controllers\JuegoController@jugar')->name('jugar');
