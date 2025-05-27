<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            📦 <span>Mis Pedidos</span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('mensaje'))
                <div class="mb-6 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-300 shadow">
                    {{ session('mensaje') }}
                </div>
            @endif

            @if(session('pedido_realizado'))
                <div class="mb-6 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-300 shadow">
                    ¡Tu pedido ha sido realizado con éxito!
                </div>
            @endif

            @if(!auth()->check())
                <div class="text-center text-red-600 font-semibold my-6">
                    ⚠️ Debes iniciar sesión para ver tus pedidos.
                </div>
            @else
                @if($pedidos->count() > 0)
                    <div class="space-y-6">
                        @foreach($pedidos as $pedido)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                                <div class="p-4 bg-gray-50 border-b flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-semibold">🧾 Pedido #{{ $pedido->id }}</h3>
                                        <p class="text-sm text-gray-600">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <span class="px-3 py-1 rounded-full text-sm font-medium
                                            @if($pedido->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                            @elseif($pedido->estado == 'completado') bg-green-100 text-green-800
                                            @elseif($pedido->estado == 'cancelado') bg-red-100 text-red-800
                                            @else bg-blue-100 text-blue-800
                                            @endif">
                                            {{ ucfirst($pedido->estado) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h4 class="font-medium mb-2">Productos:</h4>

                                    @if($pedido->detalles->count() > 0)
                                        <ul class="divide-y divide-gray-200">
                                            @foreach($pedido->detalles as $detalle)
                                                <li class="py-3 flex justify-between items-center">
                                                    <div class="flex items-center">
                                                        <span class="font-medium">{{ $detalle->cantidad }}x</span>
                                                        <span class="ml-2">
                                                            {{ $detalle->producto->nombre ?? 'Producto eliminado' }}
                                                        </span>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-sm text-gray-600">
                                                            {{ number_format($detalle->precio_unitario, 2) }}€ / unidad
                                                        </div>
                                                        <div class="font-semibold">
                                                            {{ number_format($detalle->subtotal, 2) }}€
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-red-500">No hay detalles para este pedido.</p>
                                    @endif

                                    <div class="mt-4 pt-3 border-t flex justify-end">
                                        <div class="text-xl font-bold">
                                            Total: {{ number_format($pedido->total, 2) }}€
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $pedidos->links() }}
                    </div>
                @else
                    <div class="bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="text-gray-600">🕐 No has realizado ningún pedido todavía.</p>
                    </div>
                @endif
            @endif

            <div class="mt-10 text-center">
                <a href="{{ route('productos.index') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300">
                    🏪 Volver a la Tienda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

@if(session('pedido_realizado'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Pedido realizado!',
        text: 'Tu pedido se ha procesado correctamente.',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif
