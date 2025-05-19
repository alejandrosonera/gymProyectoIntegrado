<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            📦 <span>Mis Pedidos</span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Mostrar ID del usuario autenticado (debug) --}}
            <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded shadow">
                Usuario autenticado ID: <strong>{{ auth()->id() ?? 'No autenticado' }}</strong>
            </div>

            {{-- Mensaje de sesión --}}
            @if(session('mensaje'))
                <div class="mb-6 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-300 shadow">
                    {{ session('mensaje') }}
                </div>
            @endif

            @if(!auth()->check())
                <div class="text-center text-red-600 font-semibold my-6">
                    ⚠️ Debes iniciar sesión para ver tus pedidos.
                </div>
            @else

                {{-- Listado de pedidos --}}
                @forelse ($pedidos as $pedido)
                    <div class="bg-white border rounded-lg shadow-sm p-6 mb-6 hover:shadow-lg transition duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">
                                🧾 Pedido #{{ $pedido->id }}
                            </h3>
                            <span class="inline-block bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                                {{ $pedido->created_at->format('d/m/Y') }}
                            </span>
                        </div>

                        <p class="text-gray-700 mb-4">
                            <span class="font-semibold">Total:</span>
                            <span class="text-lg font-bold text-gray-900">{{ number_format($pedido->total, 2) }} €</span>
                        </p>

                        <ul class="divide-y divide-gray-200">
                            @foreach ($pedido->detalles as $detalle)
                                <li class="py-2 flex justify-between items-center">
                                    <span class="text-gray-800">
                                        {{ $detalle->producto->nombre }}
                                    </span>
                                    <span class="text-sm text-gray-600">
                                        {{ $detalle->cantidad }} x {{ number_format($detalle->precio_unitario, 2) }} €
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <div class="text-center text-gray-500 mt-10">
                        <p class="text-lg">🕐 No has realizado ningún pedido todavía.</p>
                    </div>
                @endforelse

                {{-- Paginación --}}
                <div class="mt-8">
                    {{ $pedidos->links() }}
                </div>

            @endif

            {{-- Botón de volver --}}
            <div class="mt-10 text-center">
                <a href="{{ route('productos.index') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300">
                    🏪 Volver a la Tienda
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

{{-- Alerta SweetAlert2 --}}
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
