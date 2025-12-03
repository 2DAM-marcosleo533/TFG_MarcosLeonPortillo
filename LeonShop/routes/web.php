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

Route::get('/admin/informes', function () {
    return view('admin.informes');
})->name('admin.informes');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// PRODUCTOS
Route::get('/admin/products', [ProductoController::class, 'index'])
    ->name('admin.products');

Route::get('/admin/products/nuevo', [ProductoController::class, 'create'])
    ->name('admin.productos.create');

Route::post('/admin/products/store', [ProductoController::class, 'store'])
    ->name('admin.productos.store');

Route::get('/admin/products/{id}/edit', [ProductoController::class, 'edit'])
    ->name('admin.products.edit');

Route::put('/admin/products/{id}', [ProductoController::class, 'update'])
    ->name('admin.products.update');

Route::delete('/admin/products/{id}', [ProductoController::class, 'destroy'])
    ->name('admin.products.destroy');