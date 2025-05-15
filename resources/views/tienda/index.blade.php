<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-2xl text-gray-800 flex items-center gap-2">
                🛍️ Tienda del Gimnasio
            </h2>

            <div class="flex flex-wrap gap-3">
                @auth
                @if(auth()->user()->rol === 'admin')
                <a href="{{ route('productos.create') }}"
                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition duration-300">
                    <i class="fas fa-plus-circle"></i> Nuevo Producto
                </a>
                @elseif(auth()->user()->rol === 'cliente')
                <a href="{{ route('carritos.index') }}"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition duration-300">
                    <i class="fas fa-shopping-cart"></i> Ver Carrito
                </a>
                <a href="{{ route('pedidos.index') }}"
                    class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg shadow transition duration-300">
                    <i class="fas fa-box"></i> Mis Pedidos
                </a>
                @endif
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('mensaje'))
            <div id="mensaje"
                class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow-sm">
                <i class="fas fa-check-circle mr-2"></i> {{ session('mensaje') }}
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($productos as $producto)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl hover:scale-[1.01] transition duration-300 overflow-hidden">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}"
                        class="w-full h-48 object-cover">

                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-gray-800 mb-1">
                            {{ $producto->nombre }}
                        </h3>

                        <p class="text-sm text-gray-600 mb-3">
                            {{ $producto->descripcion }}
                        </p>

                        <p class="text-indigo-600 font-bold text-lg mb-4">
                            {{ number_format($producto->precio, 2) }} €
                        </p>

                        @auth
                        @if(auth()->user()->rol === 'cliente')
                        <form action="{{ route('carritos.store') }}" method="POST" class="mb-3">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded transition duration-300">
                                <i class="fas fa-cart-plus"></i> Añadir al Carrito
                            </button>
                        </form>
                        @endif
                        @endauth

                        @auth
                        @if(auth()->user()->rol === 'admin')
                        <div class="flex justify-between items-center mt-2 text-sm">
                            <a href="{{ route('productos.edit', $producto->id) }}"
                                class="text-green-600 hover:underline flex items-center gap-1">
                                <i class="fas fa-edit"></i> Editar
                            </a>

                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:underline flex items-center gap-1">
                                    <i class="fas fa-trash-alt"></i> Borrar
                                </button>
                            </form>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        @if(session('mensaje'))
        setTimeout(() => {
            const mensaje = document.getElementById('mensaje');
            if (mensaje) mensaje.remove();
        }, 3000);
        @endif
    </script>
</x-app-layout>
