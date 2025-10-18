<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BarangMasukController;
use App\Http\Controllers\Admin\PermintaanController;
use App\Http\Controllers\Admin\ReturanController;
use App\Http\Controllers\Admin\HistoryController;

Route::get('/login', [AuthController::class, 'loginView']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware([IsLogin::class])->group(function ()
{   
    //Dashboard Data Induk
    Route::get('/', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    
    //Kategori
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories/store', [CategoryController::class, 'store']);
    Route::delete('/categories/{id}', [CategoryController::class, 'delete']);
    
    //Barang Masuk
    Route::get('/barang-masuk', [BarangMasukController::class, 'create'])->name('barangmasuk.create');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
    
    //Permintaan
    Route::get('/permintaan', [App\Http\Controllers\Admin\PermintaanController::class, 'index'])->name('permintaan');
    Route::get('/permintaan/create', [PermintaanController::class, 'create'])->name('permintaan.create');
    Route::post('/permintaan', [PermintaanController::class, 'store'])->name('permintaan.store');
    Route::delete('/permintaan/{id}', [PermintaanController::class, 'destroy'])->name('permintaan.destroy');

    Route::get('/returan', [App\Http\Controllers\Admin\ReturanController::class, 'index'])->name('returan');
    Route::get('/returan/create', [ReturanController::class, 'create'])->name('returan.create');
    Route::post('/returan', [ReturanController::class, 'store'])->name('returan.store');
    Route::delete('/returan/{id}', [ReturanController::class, 'destroy'])->name('returan.destroy');

    Route::get('/history', [App\Http\Controllers\Admin\HistoryController::class, 'index'])->name('history');

});
Route::fallback(function () {
    return redirect('/login');
});

