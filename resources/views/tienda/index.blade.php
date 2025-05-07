<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🛍️ Tienda del Gimnasio
            </h2>
            <a href="{{ route('productos.create') }}" 
               class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                + Nuevo Producto
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($productos as $producto)
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            {{ $producto->nombre }}
                        </h3>
                        <p class="text-gray-700 text-sm mb-4">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="..." class="..." />
                        </p>
                        <p class="text-gray-700 text-sm mb-4">
                            {{ $producto->descripcion }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-semibold text-lg">
                                {{ number_format($producto->precio, 2) }} €
                            </span>
                            <button onclick="alert('Producto añadido al carrito')" class="text-white bg-indigo-500 hover:bg-indigo-600 px-3 py-1 rounded text-sm">
                                <i class="fas fa-cart-plus"></i> Añadir
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
