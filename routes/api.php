<?php

use Illuminate\Http\Request;

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



Route::post('/order', 'API\OrderController@GetOrder')->name('get.order');
Route::post('/detailorder', 'API\OrderController@GetDetailOrder')->name('detail.order');

