<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/produk', function () {
//     return view('produk');
// });

Route::get('/contoh', [ContohController::class, 'TampilContoh']);
Route::get('/produk',[ProdukController::class,'Viewproduk']);
Route::get('/produk/add',[ProdukController::class,'ViewAddProduk']);
Route::post('/produk/add',[ProdukController::class,'CreateProduk']);

Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);
Route::get('/produk/edit/{kode_produk}', [ProdukController::class,'ViewEditProduk']);
Route::put('/produk/edit/{kode_produk}', [ProdukController::class,'UpdateProduk']);
