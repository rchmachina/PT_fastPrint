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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/fetchingApiTeknikalTest', 'App\Http\Controllers\fetchingApi@fetchingApiFromFastPrint');
Route::get('/', 'App\Http\Controllers\storeController@index');
Route::post('/postBarang', 'App\Http\Controllers\storeController@create')->name('postBarang');
Route::post('/updateBarang', 'App\Http\Controllers\storeController@update')->name('updateBarang');
Route::get('/deleteBarang/{idBarang}', 'App\Http\Controllers\storeController@delete')->name("deleteBarang");

