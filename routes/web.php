<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\ProdukController;

// Route untuk login dan register
Route::get('/', function(){
    return view('login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk user dengan prefix 'user' dan middleware user-access
Route::middleware(['auth', 'user-access:user'])->prefix('user')->group(function() {
    Route::get('/contoh', [ContohController::class, 'TampilContoh'])->name('user.contoh');
    Route::get('/produk', [ProdukController::class, 'Viewproduk'])->name('user.produk');
    Route::get('/produk/add', [ProdukController::class, 'ViewAddProduk'])->name('user.addproduk');
    Route::post('/produk/add', [ProdukController::class, 'CreateProduk']);
    Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);
    Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);
    Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);
    Route::get('/laporan', [ProdukController::class, 'ViewLaporan']);
    Route::get('/report', [ProdukController::class, 'print']);
});

// Routes untuk admin dengan prefix 'admin' dan middleware user-access
Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function() {
    Route::get('/contoh', [ContohController::class, 'TampilContoh'])->name('admin.contoh');
    Route::get('/produk', [ProdukController::class, 'Viewproduk'])->name('admin.produk');
    Route::get('/produk/add', [ProdukController::class, 'ViewAddProduk'])->name('admin.addproduk');
    Route::post('/produk/add', [ProdukController::class, 'CreateProduk']);
    Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);
    Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);
    Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);
    Route::get('/laporan', [ProdukController::class, 'ViewLaporan']);
    Route::get('/report', [ProdukController::class, 'print']);
});
