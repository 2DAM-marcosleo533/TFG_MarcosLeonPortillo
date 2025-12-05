<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/producto/{producto}', [ProductoController::class, 'show'])
    ->name('producto.show');

Route::get('/admin', function () {
    return view('admin.admin');
})->name('admin');

Route::get('/admin/informes', function () {
    return view('admin.informes');
})->name('admin.informes');



Route::controller(AuthController::class)->group(function () {

    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');

    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');

    Route::post('/logout', 'logout')->name('logout');

});


Route::controller(ProductoController::class)->group(function () {

    // LISTADO
    Route::get('/admin/products', 'index')
        ->name('admin.products');

    // CREAR
    Route::get('/admin/products/nuevo', 'create')
        ->name('admin.productos.create');

    Route::post('/admin/products/store', 'store')
        ->name('admin.productos.store');

    // EDITAR
    Route::get('/admin/products/{id}/edit', 'edit')
        ->name('admin.products.edit');

    Route::put('/admin/products/{id}', 'update')
        ->name('admin.products.update');

    // ELIMINAR
    Route::delete('/admin/products/{id}', 'destroy')
        ->name('admin.products.destroy');

});
