<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📦 Mis Pedidos
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('mensaje'))
            <div class="mb-4 p-4 bg-green-500 text-white rounded">
                {{ session('mensaje') }}
            </div>
            @endif

            @forelse ($pedidos as $pedido)
            <div class="bg-white p-6 mb-4 rounded shadow">
                <h3 class="text-lg font-bold mb-2">Pedido #{{ $pedido->id }}</h3>
                <p class="mb-2">Total: <strong>{{ number_format($pedido->total, 2) }} €</strong></p>
                <ul class="list-disc ml-5">
                    @foreach ($pedido->detalles as $detalle)
                    <li>
                        {{ $detalle->producto->nombre }} - {{ $detalle->cantidad }} x {{ number_format($detalle->precio_unitario, 2) }} €
                    </li>
                    @endforeach
                </ul>
            </div>
            @empty
            <p>No has realizado ningún pedido todavía.</p>
            @endforelse

            <!-- Botón para volver a la tienda -->
            <div class="mt-6">
                <a href="{{ route('productos.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow-md transition duration-300">
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
