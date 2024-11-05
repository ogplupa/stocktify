<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiMasukController;
use Illuminate\Support\Facades\Route;

//Route for Login
Route::get('/login',[AuthController::class,'login'])-> name ('login.tampil');
Route::post('/login/submit',[AuthController::class,'submitLogin'])-> name ('login.submit');



//Route For Register
    Route::get('/',[AuthController::class,'daftar'])-> name ('tampil');
    Route::post('/submit',[AuthController::class,'submit'])-> name ('submit');




// Route For User
Route::get('/user',[UserController::class,'tampil'])-> name ('user.tampil');

Route::get('/user/tambah',[UserController::class,'tambah'])-> name ('user.tambah');
Route::post('/user/submit',[UserController::class,'submit'])-> name ('user.submit');
Route::get('/user/edit/{id}',[UserController::class,'edit'])-> name ('user.edit');
Route::put('/user/update/{id}',[UserController::class,'update'])-> name ('user.update');
Route::post('/user/delete/{id}',[UserController::class,'delete'])-> name ('user.delete');

// Route For Products
Route::get('/product/barang',[ProductController::class,'tampil'])-> name ('product.tampil');
Route::get('/product/barang/tambah',[ProductController::class,'tambah'])-> name ('product.tambah');
Route::post('/product/barang/submit',[ProductController::class,'submit'])-> name ('product.submit');
Route::get('/product/barang/edit/{id}',[ProductController::class,'edit'])-> name ('product.edit');
Route::put('/product/barang/update/{id}',[ProductController::class,'update'])-> name ('product.update');
Route::delete('/product/barang/delete/{id}',[ProductController::class,'delete'])-> name ('product.delete');

// Route For Kategori
Route::get('/product/category',[CategoryController::class,'tampil'])->name('category.tampil');
Route::get('/product/category/tambah',[CategoryController::class,'tambah'])->name('product.category.tambah');
Route::post('/product/category/submit',[CategoryController::class,'submit'])->name('product.category.submit');
Route::get('/product/category/edit/{id}',[CategoryController::class,'edit'])->name('product.category.edit');
Route::put('/product/category/update/{id}',[CategoryController::class,'update'])->name('product.category.update');
Route::post('/product/category/delete/{id}',[CategoryController::class,'delete'])->name('product.category.delete');
// Route For Supplier
Route::get('/product/supplier',[SupplierController::class,'tampil'])->name('product.supplier.tampil');
Route::post('/product/supplier/tambah',[SupplierController::class,'tambah'])->name('product.supplier.tambah');
Route::post('/product/supplier/submit',[SupplierController::class,'submit'])->name('product.supplier.submit');
Route::get('/product/supplier/edit/{id}',[SupplierController::class,'edit'])->name('product.supplier.edit');
Route::put('/product/supplier/update/{id}',[SupplierController::class,'update'])->name('product.supplier.update');
Route::post('/product/supplier/delete/{id}',[SupplierController::class,'delete'])->name('product.supplier.delete');
// Route For Transaksi
Route::get('/transaksi/masuk',[TransaksiController::class,'tampil'])->name('transaksi.masuk.tampil');
Route::get('/transaksi/masuk/tambah',[TransaksiController::class,'tambah'])->name('transaksi.masuk.tambah');
Route::post('/transaksi/masuk/submit',[TransaksiController::class,'submit'])->name('transaksi.masuk.submit');
Route::get('/transaksi/masuk/edit/{id}',[TransaksiController::class,'edit'])->name('transaksi.masuk.edit');
Route::put('/transaksi/masuk/update/{id}',[TransaksiController::class,'update'])->name('transaksi.masuk.update');
Route::delete('/transaksi/masuk/delete/{id}',[TransaksiController::class,'delete'])->name('transaksi.masuk.delete');
