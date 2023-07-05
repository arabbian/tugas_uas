<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route :: get('/produk',[ProdukController::class,'getproduk']);
Route :: get('/produk/{id}',[ProdukController::class,'getidproduk']);
Route :: post('/produk',[ProdukController::class,'tambahproduk']);
Route :: put('/produk/{id}',[ProdukController::class, 'updateproduk']);
Route :: delete('/produk/{id}',[ProdukController::class, 'deleteproduk']);

Route :: get('/pelanggan',[PelangganController::class,'getpelanggan']);
Route :: get('/pelanggan/{id}',[PelangganController::class,'getidpelanggan']);
Route :: post('/pelanggan',[PelangganController::class,'tambahpelanggan']);
Route :: put('/pelanggan/{id}',[PelangganController::class, 'updatepelanggan']);
Route :: delete('/pelanggan/{id}',[PelangganController::class, 'deletepelanggan']);
Route :: patch('/pelanggan/{id}',[PelangganController::class,'updatepelanggan']);

Route :: get('/pesanan',[PesananController::class, 'getpesanan']);
Route :: get('/idpesanan/{id}',[PesananController::class, 'getidpesanan']);
Route :: post('/pesanan',[PesananController::class,'createpesanan']);
Route :: put('/pesanan/{id}',[PesananController::class, 'updatepesanan']);
Route :: delete('/pesanan/{id}',[PesananController::class, 'deletepesanan']);
Route :: put('/sudahdkr/{id}',[PesananController::class, 'sudahdkr']);



