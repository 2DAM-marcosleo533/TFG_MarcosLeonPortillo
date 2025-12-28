<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DireccionController;

//la pagina principal
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

//panel del admin
Route::get('/admin', function () {
    return view('admin.admin');
})->name('admin');


Route::controller(ProductoController::class)->group(function () {

    // detalles del producto
    Route::get('/producto/{producto}', 'show')
        ->name('producto.show');

    // Listado de productos
    Route::get('/admin/products', 'index')
        ->name('admin.products');

    // creacion de productos
    Route::get('/admin/products/nuevo', 'create')
        ->name('admin.productos.create');

    Route::post('/admin/products/store', 'store')
        ->name('admin.productos.store');

    // ediicon de productos
    Route::get('/admin/products/{id}/edit', 'edit')
        ->name('admin.products.edit');

    Route::put('/admin/products/{id}', 'update')
        ->name('admin.products.update');

    // eliminacion de productos
    Route::delete('/admin/products/{id}', 'destroy')
        ->name('admin.products.destroy');
});


//informes que ve el admin
Route::controller(InformeController::class)->group(function () {
    Route::get('/admin/informes', 'index')->name('admin.informes');
});



Route::controller(UserController::class)->group(function () {
    Route::get('/perfil', 'edit')->name('perfil.edit');
    Route::post('/perfil', 'update')->name('perfil.update');
});

Route::controller(DireccionController::class)->group(function () {
    Route::post('/direcciones', 'store')->name('direcciones.store');
});

Route::controller(ComentarioController::class)
    ->middleware('auth')
    ->group(function () {

        Route::get('/producto/{producto}/comentario', 'create')
            ->name('comentarios.create');

        Route::post('/producto/{producto}/comentario', 'store')
            ->name('comentarios.store');

        Route::get('/comentario/{comentario}/editar', 'edit')
            ->name('comentarios.edit');

        Route::put('/comentario/{comentario}', 'update')
            ->name('comentarios.update');

        Route::delete('/comentario/{comentario}', 'destroy')
            ->name('comentarios.destroy');
});



Route::controller(CompraController::class)->group(function () {

    Route::get('/compra/{producto}', 'create')
        ->name('compras.create');

    Route::post('/compra/{producto}', 'store')
        ->name('compras.store');
});



Route::controller(AuthController::class)->group(function () {

    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');

    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');

    Route::post('/logout', 'logout')->name('logout');
});
