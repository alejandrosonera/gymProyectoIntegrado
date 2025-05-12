<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛒 Mi Carrito
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-lg font-semibold mb-4">Productos añadidos al carrito:</h3>

            @if(session('mensaje'))
            <div class="mb-4 p-4 bg-green-500 text-white rounded">
                {{ session('mensaje') }}
            </div>
            @endif

            @if ($carrito->isEmpty())
            <p>No hay productos en tu carrito.</p>
            @else
            <!-- Botón para vaciar el carrito -->
            <form action="{{ route('carritos.vaciar') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres vaciar el carrito?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded shadow-md transition duration-300 mb-6">
                    🗑️ Vaciar Carrito
                </button>
            </form>

            <!-- Lista de productos -->
            <ul class="space-y-4">
                @foreach ($carrito as $item)
                <li class="p-4 bg-white rounded shadow flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="mb-2 md:mb-0">
                        <strong class="text-lg">{{ $item->producto->nombre }}</strong><br>
                        <span class="text-gray-600">Precio:</span> {{ number_format($item->producto->precio, 2) }} €<br>
                        <span class="text-gray-600">Cantidad:</span> {{ $item->cantidad }}
                    </div>

                    <div class="flex space-x-2 mt-2 md:mt-0">
                        <!-- Botón Eliminar 1 -->
                        <form action="{{ route('carritos.eliminarUnidad', $item->id) }}" method="POST" onsubmit="return confirm('¿Eliminar una unidad de este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center bg-red-100 text-red-600 hover:bg-red-200 font-semibold px-3 py-1 rounded transition duration-200 shadow-sm">
                                <i class="fas fa-minus mr-1"></i> Eliminar 1
                            </button>
                        </form>

                        <!-- Botón Añadir 1 -->
                        <form action="{{ route('carritos.agregarUnidad', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center bg-green-100 text-green-600 hover:bg-green-200 font-semibold px-3 py-1 rounded transition duration-200 shadow-sm">
                                <i class="fas fa-plus mr-1"></i> Añadir 1
                            </button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
            <!-- Botón para realizar pedido -->
            <form action="{{ route('pedidos.store') }}" method="POST" onsubmit="return confirm('¿Deseas finalizar y realizar este pedido?')">
                @csrf
                <button type="submit" class="mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow">
                    <i class="fas fa-check-circle"></i> Realizar Pedido
                </button>
            </form>
            @endif

            <!-- Botón Volver a la Tienda -->
            <div class="mt-6">
                <a href="{{ route('productos.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow-md transition duration-300">
                    🏪 Volver a la Tienda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
