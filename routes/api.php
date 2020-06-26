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

Route::post('/customer_signup', 'CustomerController@postCustomer');
Route::post('/signup', 'PenggunaController@store');

















Route::get('/agency/{id}', 'StafController@getAgency');

Route::get('/product/{id}', 'CustomerController@getProduct');
Route::get('/barang/{id}', 'BarangController@getBarang');

Route::post('inputtiket', 'TiketController@APIStoreTiket');
Route::post('masuk', 'CustomerController@masuk');
Route::post('tagihan', 'CustomerController@tagihan');
Route::post('daftarTransaksi', 'CustomerController@daftarTransaksi');
Route::post('riwayatTagihan', 'CustomerController@riwayatTagihan');

Route::post('newBank', 'SlipOrderController@simpanNewBank');
Route::get('/bank', 'SlipOrderController@getBank');

Route::post('newSalesManager', 'StafController@simpanNewSalesManager');
Route::post('newSales', 'StafController@simpanNewSales');
Route::get('/sales', 'StafController@getSales');

Route::get('/salesManager', 'StafController@getSalesManager');

Route::post('settingBiayaSewa', 'SlipOrderController@settingBiayaSewa');

Route::post('newInstalasi', 'InstalasiController@simpanProses');


Route::post('newTeknisi', 'StafController@simpanNewTeknisi');
Route::get('/daftarTeknisi', 'StafController@getTeknisi');

//new bank
// Route::resource('newBank', 'CustomerController')->except([
//     'create', 'edit'
// ]);



