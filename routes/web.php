<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('caycanh/theloai/{id}', [HomeController::class, 'theloai']);
Route::post('/timkiem', [HomeController::class, 'timkiem']);


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\Qnhu_Controller;

Route::get('/login', [Qnhu_Controller::class, 'showLogin'])->name('login');
Route::get('/register', [Qnhu_Controller::class, 'showRegister'])->name('register');

require __DIR__ . '/auth.php';
