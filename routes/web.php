<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Livewire\Clase;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::get('/tienda', [ProductoController::class, 'index'])->name('tienda.index');

Route::resource('productos', ProductoController::class);

// Rutas públicas para confirmar pedido (si debe ser público)
Route::post('/pedido/confirmar', [PedidoController::class, 'confirmar'])->name('pedido.confirmar');

// Rutas protegidas, solo usuarios autenticados y verificados
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Livewire Clase
    Route::get('showclases', Clase::class)->name('showclases');

    // Pedidos
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

    // Carrito
    Route::get('/carritos', [CarritoController::class, 'index'])->name('carritos.index');
    Route::post('/carritos', [CarritoController::class, 'store'])->name('carritos.store');
    Route::delete('/carritos/vaciar', [CarritoController::class, 'vaciar'])->name('carritos.vaciar');
    Route::delete('/carritos/{carrito}/eliminar-unidad', [CarritoController::class, 'eliminarUnidad'])->name('carritos.eliminarUnidad');
    Route::post('/carritos/{carrito}/agregar-unidad', [CarritoController::class, 'agregarUnidad'])->name('carritos.agregarUnidad');

    // Pago
    Route::get('/pago', [PagoController::class, 'form'])->name('pago.form');
    Route::post('/pago', [PagoController::class, 'pagar'])->name('pago.procesar');

    // Pago por planes (el {plan} indica el plan seleccionado)
    Route::get('/pago/plan/{plan}', [PagoController::class, 'formPlan'])->name('pago.plan.form');
    Route::post('/pago/plan', [PagoController::class, 'pagarPlan'])->name('pago.plan.pagar');
});
