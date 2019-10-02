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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('karyawan', 'KaryawanController');
Route::resource('supplier', 'SupplierController');
Route::resource('konsumen', 'KonsumenController');
Route::resource('barang', 'BarangController');
Route::resource('beli', 'BeliController');
Route::resource('detailbeli', 'DetailbeliController');
Route::get('detailbeli/tutup/{id?}', 'DetailbeliController@tutup');
Route::get('detailbeli/cetak/{id?}', 'DetailbeliController@cetak');

Route::resource('proses', 'ProsesController');
Route::get('proses/pengeringan/{id?}/{id1?}', 'ProsesController@pengeringan');
Route::resource('detailproses', 'DetailprosesController');
Route::post('addproses', 'DetailbeliController@addproses'); 
Route::post('pengeringan', 'DetailprosesController@pengeringan'); 
Route::post('sortir', 'DetailprosesController@sortir'); 
Route::post('endsortir', 'DetailprosesController@endsortir'); 
Route::post('endpengeringan', 'DetailprosesController@endpengeringan');
Route::get('endproses/{id}', 'DetailprosesController@endproses');
Route::resource('setting', 'SettingPenjualan');