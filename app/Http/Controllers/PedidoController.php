<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetallePedido;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::where('user_id', Auth::id())
            ->with('detalles.producto')
            ->orderByDesc('created_at')
            ->paginate(5);

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
        try {
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
                // Calcula el subtotal explícitamente
                $precioUnitario = $item->producto->precio;
                $subtotal = $precioUnitario * $item->cantidad;

                // Log para depuración
                \Log::info('Datos para crear detalle pedido:', [
                    'pedido_id' => $pedido->id,
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                    'precio_unitario' => $precioUnitario,
                    'subtotal' => $subtotal
                ]);

                // Crear el detalle del pedido
                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                    'precio_unitario' => $precioUnitario,
                    'subtotal' => $subtotal
                ]);
            }

            // Vaciar el carrito
            Carrito::where('user_id', $user->id)->delete();

            return redirect()->route('pedidos.index')->with('pedido_realizado', true);
        } catch (\Exception $e) {
            \Log::error('Error al crear pedido: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al procesar tu pedido: ' . $e->getMessage());
        }
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
