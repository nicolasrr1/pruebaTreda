<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\\Http\\Controllers')->group(function () {


    Route::get('/Producto', 'ProductoControler@index');
    Route::post('/Producto', 'ProductoControler@storage');
    Route::put('/Producto', 'ProductoControler@update');
    Route::delete('/Producto/{id}', 'ProductoControler@delete');
    Route::get('/Producto/Tienda/{id}', 'ProductoControler@productoTienda');

    //tienda
    Route::get('/tienda', 'TiendaController@index');
    Route::post('/tienda', 'TiendaController@storage');
    Route::get('/tiendaelim/{id}', 'TiendaController@delete');
    Route::get('/cargar/{id}', 'TiendaController@cargar');
    Route::put('/tienda', 'TiendaController@update');


    
});
