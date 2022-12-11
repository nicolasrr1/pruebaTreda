<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('App\\Http\\Controllers')->group(function () {
    Route::get('/Producto/Tienda/{id}', 'ProductoControler@productoTienda');
    Route::post('/Producto', 'ProductoControler@storage')->name('Producto');
    Route::get('/Producto', 'ProductoControler@index');

    Route::post('/ProductoUpdate', 'ProductoControler@update')->name("ProductoUpdate");
    Route::get('/ProductoEliminar/{id}', 'ProductoControler@delete');
    Route::get('/Producto/Tienda/{id}', 'ProductoControler@productoTienda');

});
