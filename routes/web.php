<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TreeController_VA;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('caycanh/theloai/{id}', [HomeController::class, 'theloai']);
Route::post('/timkiem', [HomeController::class, 'timkiem']);

Route::get('/caycanh/{id}', [TreeController_VA::class, 'detail'])
    ->name('caycanh.detail');

Route::get('quan-ly-san-pham', [HomeController::class, 'quanLySanPham']);
Route::get('quan-ly-san-pham/them', [HomeController::class, 'themSanPham'])->name('sanpham.them');
Route::post('quan-ly-san-pham', [HomeController::class, 'luuSanPham'])->name('sanpham.luu');
Route::post('sanpham/xoa/{id}', [HomeController::class, 'xoaSanPham'])->name('sanpham.xoa');


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/caycanh/add-cart', [TreeController_VA::class, 'addToCart'])
    ->name('caycanh.addCart');
Route::get('/gio-hang', [TreeController_VA::class, 'cart'])
    ->name('giohang');
Route::get('/gio-hang/xoa/{id}', [TreeController_VA::class, 'remove'])
    ->name('giohang.remove');
Route::post('/gio-hang/dat-hang', [TreeController_VA::class, 'checkout'])
    ->name('giohang.checkout');

require __DIR__ . '/auth.php';
