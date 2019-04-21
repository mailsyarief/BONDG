<?php

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
    return redirect('/login');
});


Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/input-bondg', 'AdminController@showform_bondg');
Route::get('/bondg', 'AdminController@status_bondg');
Route::post('/bondg', 'AdminController@input_bondg');
Route::post('/detail-bondg', 'AdminController@detail_bondg');
Route::post('/hapus-bondg', 'AdminController@hapus_bondg');
Route::post('/edit-bondg/{id}', 'AdminController@edit_bondg');
