<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('caycanh/theloai/{id}', [HomeController::class, 'theloai']);
Route::post('/timkiem', [HomeController::class, 'timkiem']);


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__ . '/auth.php';
