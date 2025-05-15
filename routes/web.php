<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Livewire\Clase;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('showclases', Clase::class)->name('showclases');
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::get('/carritos', [CarritoController::class, 'index'])->name('carritos.index')->middleware('auth');
    Route::post('/carritos', [CarritoController::class, 'store'])->name('carritos.store')->middleware('auth');
    Route::delete('/carritos/vaciar', [CarritoController::class, 'vaciar'])->name('carritos.vaciar');
    Route::delete('/carritos/{carrito}/eliminar-unidad', [CarritoController::class, 'eliminarUnidad'])->name('carritos.eliminarUnidad');
    Route::post('/carritos/{carrito}/agregar-unidad', [CarritoController::class, 'agregarUnidad'])->name('carritos.agregarUnidad');
});

Route::get('/tienda', [ProductoController::class, 'index'])->name('tienda.index');

Route::resource('productos', ProductoController::class);

Route::post('/pedido/confirmar', [PedidoController::class, 'confirmar'])->name('pedido.confirmar');

Route::get('/pago', [App\Http\Controllers\PagoController::class, 'form'])->name('pago.form');
Route::post('/pago', [App\Http\Controllers\PagoController::class, 'pagar'])->name('pago.procesar');

