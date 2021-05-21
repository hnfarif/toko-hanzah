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



// Route::get('/', 'DashboardController@index');
Route::get('/', 'DashboardController@index');

Route::group(['prefix' => '/'], function () {
    // master
    Route::get('dashboard', 'DashboardController@index');
    Route::get('barang', 'BarangController@index');
    Route::get('barang/input', 'BarangController@show');
    Route::post('barang/input/store', 'BarangController@store');
    Route::get('barang/{barang}/edit', 'BarangController@edit');
    Route::patch('barang/{barang}/update', 'BarangController@update');
    Route::get('barang/{barang}/delete', 'BarangController@destroy');
    Route::get('barang/cetak-pdf', 'BarangController@cetak_pdf');
    Route::post('barang/getFilter', 'BarangController@getFilter');

    Route::get('pelanggan', 'PelangganController@index');
    Route::get('pelanggan/input', 'PelangganController@show');
    Route::post('pelanggan/input/store', 'PelangganController@store');
    Route::get('pelanggan/{pelanggan}/edit', 'PelangganController@edit');
    Route::patch('pelanggan/{pelanggan}/update', 'PelangganController@update');
    Route::get('pelanggan/{pelanggan}/delete', 'PelangganController@destroy');
    Route::get('pelanggan/cetak-pdf', 'PelangganController@cetak_pdf');
    Route::post('pelanggan/getFilter', 'PelangganController@getFilter');

    Route::get('pemasok', 'PemasokController@index');
    Route::get('pemasok/input', 'PemasokController@show');
    Route::post('pemasok/input/store', 'PemasokController@store');
    Route::get('pemasok/{pemasok}/edit', 'PemasokController@edit');
    Route::patch('pemasok/{pemasok}/update', 'PemasokController@update');
    Route::get('pemasok/{pemasok}/delete', 'PemasokController@destroy');
    Route::get('pemasok/cetak-pdf', 'PemasokController@cetak_pdf');
    Route::post('pemasok/getFilter', 'PemasokController@getFilter');


    // transaksi
    Route::get('pembelian', 'PembelianController@index');
    Route::post('pembelian/input/store', 'PembelianController@store');
    Route::get('pembelian/input', 'PembelianController@show');
    Route::post('pembelian/input/list', 'PembelianController@listBarang');
    Route::get('pembelian/input/searchbarang', 'PembelianController@dataBarang');
    Route::get('pembelian/input/searchtoko', 'PembelianController@dataToko');
    Route::get('pembelian/input/deletelist/{namabarang}', 'PembelianController@deleteBarang');
    Route::get('pembelian/{pembelian}/delete', 'PembelianController@destroy');
    Route::get('pembelian/{pembelian}/edit', 'PembelianController@edit');
    Route::patch('pembelian/{pembelian}/update', 'PembelianController@update');
    Route::get('pembelian/cetak-pdf', 'PembelianController@cetak_pdf');
    Route::post('pembelian/getFilter', 'PembelianController@getFilter');


    Route::get('penjualan', 'PenjualanController@index');
    Route::post('penjualan/input/store', 'PenjualanController@store');
    Route::get('penjualan/input', 'PenjualanController@show');
    Route::post('penjualan/input/list', 'PenjualanController@listBarang');
    Route::get('penjualan/input/searchbarang', 'PenjualanController@dataBarang');
    Route::get('penjualan/input/searchpelanggan', 'PenjualanController@dataPelanggan');
    Route::get('penjualan/input/getHarga', 'PenjualanController@getHarga');
    Route::get('penjualan/input/deletelist/{namabarang}', 'PenjualanController@deleteBarang');
    Route::get('penjualan/{penjualan}/delete', 'PenjualanController@destroy');
    Route::get('penjualan/{penjualan}/edit', 'PenjualanController@edit');
    Route::patch('penjualan/{penjualan}/update', 'PenjualanController@update');
    Route::get('penjualan/deleteListAll', 'PenjualanController@deleteListAll');
    Route::get('penjualan/cetak-pdf', 'PenjualanController@cetak_pdf');
    Route::post('penjualan/getFilter', 'PenjualanController@getFilter');

});
