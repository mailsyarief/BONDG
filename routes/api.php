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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'API\OrderController@login')->name('login');
Route::post('/logout', 'API\OrderController@logout')->name('logout');
Route::post('/order', 'API\OrderController@GetOrder')->name('get.order');
Route::post('/detailorder', 'API\OrderController@GetDetailOrder')->name('detail.order');
Route::post('/cancelorder', 'API\OrderController@CancelOrder')->name('cancel.order');
Route::post('/doorder', 'API\OrderController@DoOrder')->name('do.order');