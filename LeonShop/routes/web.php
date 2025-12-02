<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/admin', function () {
    return view('admin.admin');
})->name('admin');

// Lista de productos
Route::get('/admin/products', function () {
    return view('admin.products');
})->name('admin.products');

// Informes
Route::get('/admin/informes', function () {
    return view('admin.informes');
})->name('admin.informes');

Route::get('/admin/products', [ProductoController::class, 'index'])
    ->name('admin.products');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');