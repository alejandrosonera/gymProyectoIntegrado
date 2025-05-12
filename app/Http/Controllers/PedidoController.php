<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetallePedido;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::where('user_id', Auth::id())->with('detalles.producto')->get();
        return view('pedidos.index', compact('pedidos'));
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
        $user = Auth::user();
        $carrito = Carrito::where('user_id', $user->id)->with('producto')->get();

        if ($carrito->isEmpty()) {
            return redirect()->back()->with('mensaje', 'Tu carrito está vacío.');
        }

        $total = $carrito->sum(fn($item) => $item->producto->precio * $item->cantidad);

        $pedido = Pedido::create([
            'user_id' => $user->id,
            'total' => $total,
            'estado' => 'pendiente',
        ]);


        foreach ($carrito as $item) {
            $precioUnitario = $item->producto->precio;
            $cantidad = $item->cantidad;

            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item->producto_id,
                'cantidad' => $cantidad,
                'precio_unitario' => $precioUnitario,
                'subtotal' => $precioUnitario * $cantidad,
            ]);
        }

        Carrito::where('user_id', $user->id)->delete();

        return redirect()->route('pedidos.index')->with('mensaje', '¡Pedido realizado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
