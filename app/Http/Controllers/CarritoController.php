<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();

        if ($usuario->rol !== 'cliente') {
            abort(403); // No permitir a admin/entrenador
        }

        $carrito = $usuario->carritos()->with('producto')->get();

        return view('carritos.index', compact('carrito'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $user = auth()->user();
        $producto = \App\Models\Producto::findOrFail($request->producto_id);
        $cantidad = $request->cantidad;
        $subtotal = $producto->precio * $cantidad;

        // Verifica si ya existe ese producto en el carrito del usuario
        $itemExistente = $user->carritos()->where('producto_id', $producto->id)->first();

        if ($itemExistente) {
            $itemExistente->cantidad += $cantidad;
            $itemExistente->subtotal = $itemExistente->cantidad * $producto->precio;
            $itemExistente->save();
        } else {
            $user->carritos()->create([
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal,
            ]);
        }

        return redirect()->back()->with('mensaje', 'Producto añadido al carrito');
    }


    public function vaciar()
    {
        $usuario = auth()->user();

        // Borra todos los ítems del carrito de ese usuario
        $usuario->carritos()->delete();

        return redirect()->route('carritos.index')->with('mensaje', 'Carrito vaciado correctamente.');
    }

    public function eliminarUnidad(Carrito $carrito)
    {
        if ($carrito->user_id !== auth()->id()) {
            abort(403);
        }

        if ($carrito->cantidad > 1) {
            $carrito->cantidad -= 1;
            $carrito->subtotal = $carrito->cantidad * $carrito->producto->precio;
            $carrito->save();
        } else {
            $carrito->delete(); // Si solo hay 1 unidad, la elimina por completo
        }

        return redirect()->route('carritos.index')->with('mensaje', 'Producto actualizado en el carrito.');
    }

    public function agregarUnidad(Carrito $carrito)
    {
        $carrito->cantidad += 1;
        $carrito->subtotal = $carrito->producto->precio * $carrito->cantidad;
        $carrito->save();

        return redirect()->route('carritos.index')->with('mensaje', 'Unidad añadida correctamente.');
    }





    /**
     * Display the specified resource.
     */
    public function show(Carrito $carrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrito $carrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrito $carrito)
    {
        //
    }
}
