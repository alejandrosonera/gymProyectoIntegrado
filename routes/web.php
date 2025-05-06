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
});

Route::get('/tienda', [ProductoController::class, 'index'])->name('tienda.index');

Route::resource('productos', ProductoController::class);
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');
Route::post('/pedido/confirmar', [PedidoController::class, 'confirmar'])->name('pedido.confirmar');
