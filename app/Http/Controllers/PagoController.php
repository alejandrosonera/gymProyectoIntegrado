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
                'description' => $request->plan ? 'Pago suscripción plan ' . $request->plan : 'Pago de pedido',
                'source' => $request->stripeToken,
            ]);

            $user = auth()->user();

            if ($request->has('plan')) {
                // Si es un pago de plan: NO crear pedido, sólo redirigir a clases con mensaje
                return redirect()->route('showclases')->with('success', 'Suscripción realizada con éxito.');
            } else {
                // Pago normal, crear pedido

                $pedido = $user->pedidos()->create([
                    'nombre' => 'Pedido realizado el ' . now()->format('d/m/Y H:i'),
                    'estado' => 'procesado',
                    'cantidad' => $request->cantidad ?? 1,
                    'total' => $request->total,
                ]);

                // Vaciar carrito
                $user->carritos()->delete();

                return redirect()->route('pedidos.index')->with('pedido_realizado', true);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }


    public function formPlan($plan)
    {
        // Definimos los precios y nombres de los planes (podrías obtenerlo de BD también)
        $planes = [
            'basico' => 29,
            'premium' => 49,
            'elite' => 79,
        ];

        if (!array_key_exists($plan, $planes)) {
            abort(404);
        }

        $precio = $planes[$plan];
        $nombrePlan = ucfirst($plan);

        return view('pago.plan', [
            'total' => $precio,
            'plan' => $nombrePlan,
        ]);
    }

    public function pagarPlan(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $amount = (int) round($request->total * 100);

            Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'description' => 'Pago suscripción plan ' . $request->plan,
                'source' => $request->stripeToken,
            ]);

            // No se crea pedido, solo redirige a clases con mensaje
            return redirect('/clases')->with('success', 'Suscripción realizada con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }
}
