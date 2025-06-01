<?php

use App\Http\Controllers\auth\CambiarContraseña;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Livewire\Clase;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', [InicioController::class, 'index'])->name('inicio');

// Tienda
Route::get('/tienda', [ProductoController::class, 'index'])->name('tienda.index');

// CRUD de productos
Route::resource('productos', ProductoController::class);

// Confirmación de pedidos (pública si se requiere)
Route::post('/pedido/confirmar', [PedidoController::class, 'confirmar'])->name('pedido.confirmar');

// Autenticación con Google
Route::get('/auth/redirect/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/callback/google', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');


Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');


// 🛡️ Rutas protegidas (usuarios autenticados y verificados)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Livewire: Mostrar clases
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

    // Pago por planes
    Route::get('/pago/plan/{plan}', [PagoController::class, 'formPlan'])->name('pago.plan.form');
    Route::post('/pago/plan', [PagoController::class, 'pagarPlan'])->name('pago.plan.pagar');
});
