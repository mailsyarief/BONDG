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

// Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); 
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/home', 'PetugasController@index')->name('home');
Route::get('/dashboard', 'AdminController@index')->name('dashboard');

Route::get('/input-bondg', 'AdminController@showform_bondg');
Route::get('/input-ap2t', 'AdminController@showform_ap2t');
Route::get('/bondg', 'AdminController@status_bondg');
Route::post('/bondg', 'AdminController@filter_bondg');
Route::post('/input-bondg', 'AdminController@input_bondg');
Route::post('/detail-bondg', 'AdminController@detail_bondg');
Route::post('/hapus-bondg', 'AdminController@hapus_bondg');
Route::post('/edit-bondg/{id}', 'AdminController@edit_bondg');

Route::post('/form-ap2t', 'AdminController@search_bondg');
Route::post('/tambah-ap2t', 'AdminController@input_ap2t');
Route::get('/register-akun', 'AdminController@showform_akun');
Route::post('/register-akun', 'AdminController@register_akun');
Route::get('/daftar-akun', 'AdminController@akun'); 
Route::post('/aktifkan-akun', 'AdminController@activate_akun');
Route::get('/input-petugas', 'AdminController@showform_petugas');
Route::post('/input-petugas', 'AdminController@search_bondg_2');
Route::post('/tambah-petugas', 'AdminController@tambah_petugas');
Route::get('/remaja', 'AdminController@show_remaja');
Route::post('/remaja', 'AdminController@remaja');
Route::post('/downloadbondg', 'AdminController@ExportBondg');
Route::post('/downloadpenagihan', 'AdminController@ExportPenagihan');
Route::get('/penagihan', 'AdminController@penagihan');
Route::post('/penagihan', 'AdminController@filter_penagihan');

Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/profile', 'HomeController@suntingProfile')->name('post.profile');
Route::get('/laporan', 'ViewerController@index')->name('viewer.laporan');
Route::post('/password', 'HomeController@gantiPassword')->name('post.password');

//newest
Route::get('/foto-berita-acara/{id}', 'AdminController@fotoBeritaAcara');
Route::post('/remaja2', 'AdminController@remaja2');
Route::post('/upload-gangguan', 'AdminController@importGangguan');
Route::get('/unduh-template', 'AdminController@unduhTemplate');
// newest of newest
Route::get('/tambah-akun', 'AdminController@showform_akun');
Route::post('/ganti-password-akun', 'AdminController@gantiPassword');