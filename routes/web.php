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


Auth::routes();

// Rotas que necessitam de login
Route::group(['prefix' => '', 'as' => '', 'middleware' => ['auth']], function () {
    
    // Rotas para dashboard
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Rotas para cliente
        Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index');
        Route::get('/clientes/create', [App\Http\Controllers\ClienteController::class, 'create'])->name('clientes.create');
        Route::post('/clientes', [App\Http\Controllers\ClienteController::class, 'store'])->name('clientes.store');
        Route::get('/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'show'])->name('clientes.show');
        Route::put('/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'update'])->name('clientes.update');
        Route::delete('/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('clientes.destroy');
        Route::get('/clientes/{id}/edit', [App\Http\Controllers\ClienteController::class, 'edit'])->name('clientes.edit');

    // Rotas para produtos
        Route::get('/produtos', [App\Http\Controllers\ProdutoController::class, 'index'])->name('produtos.index');
        Route::get('/produtos/create', [App\Http\Controllers\ProdutoController::class, 'create'])->name('produtos.create');
        Route::post('/produtos', [App\Http\Controllers\ProdutoController::class, 'store'])->name('produtos.store');
        Route::get('/produtos/{id}', [App\Http\Controllers\ProdutoController::class, 'show'])->name('produtos.show');
        Route::put('/produtos/{id}', [App\Http\Controllers\ProdutoController::class, 'update'])->name('produtos.update');
        Route::delete('/produtos/{id}', [App\Http\Controllers\ProdutoController::class, 'destroy'])->name('produtos.destroy');
        Route::get('/produtos/{id}/edit', [App\Http\Controllers\ProdutoController::class, 'edit'])->name('produtos.edit');
        
    // Rotas para pedidos
        Route::get('/pedidos', [App\Http\Controllers\PedidoController::class, 'index'])->name('pedidos.index');
        Route::get('/pedidos/create', [App\Http\Controllers\PedidoController::class, 'create'])->name('pedidos.create');
        Route::post('/pedidos', [App\Http\Controllers\PedidoController::class, 'store'])->name('pedidos.store');
        Route::get('/pedidos/{id}', [App\Http\Controllers\PedidoController::class, 'show'])->name('pedidos.show');
        Route::put('/pedidos/{id}', [App\Http\Controllers\PedidoController::class, 'update'])->name('pedidos.update');
        Route::delete('/pedidos/{id}', [App\Http\Controllers\PedidoController::class, 'destroy'])->name('pedidos.destroy');
        Route::get('/pedidos/{id}/edit', [App\Http\Controllers\PedidoController::class, 'edit'])->name('pedidos.edit');
});

// Rotas AJAX 
Route::group(['prefix' => 'ajax', 'as' => '', 'middleware' => ['auth']], function () {
    Route::post('/destroyClientesSelected', [App\Http\Controllers\ClienteController::class, 'destroyAll']);
    Route::post('/destroyProdutosSelected', [App\Http\Controllers\ProdutoController::class, 'destroyAll']);
    Route::post('/destroyPedidosSelected', [App\Http\Controllers\PedidoController::class, 'destroyAll']);

});
