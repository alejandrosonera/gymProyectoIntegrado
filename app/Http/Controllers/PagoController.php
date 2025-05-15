<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class PagoController extends Controller
{
    public function form()
    {
        $user = auth()->user();

        $carrito = $user->carritos()->with('producto')->get();

        if ($carrito->isEmpty()) {
            return redirect()->route('tienda.index')->with('mensaje', 'Tu carrito está vacío.');
        }

        $total = $carrito->sum(function ($item) {
            return $item->producto->precio * $item->cantidad;
        });

        return view('pago.form', [
            'total' => $total
        ]);
    }

    public function pagar(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $amount = (int) round($request->total * 100);

            Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'description' => 'Pago de pedido',
                'source' => $request->stripeToken,
            ]);

            // Guardar pedido en DB
            $user = auth()->user();

            // Crear pedido
            $pedido = $user->pedidos()->create([
                'nombre' => 'Pedido realizado el ' . now()->format('d/m/Y H:i'),
                'estado' => 'procesado',  // <-- asegúrate que sea string con comillas simples o dobles
                'cantidad' => $request->cantidad ?? 1,
                'total' => $request->total,
            ]);



            // Aquí podrías también guardar detalle del pedido, productos, etc.
            // Por ejemplo, copiar los productos del carrito al pedido

            // Vaciar carrito (implementar método vaciar)
            $user->carritos()->delete();

            return redirect()->route('pedidos.index')->with('pedido_realizado', true);
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }
}
