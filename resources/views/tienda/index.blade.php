<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🛍️ Tienda del Gimnasio
            </h2>

            @auth
                @if(auth()->user()->rol === 'admin')
                    <a href="{{ route('productos.create') }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        + Nuevo Producto
                    </a>
                @endif
                <div class="flex space-x-2">
                    <!-- Mostrar el botón solo si el usuario NO es admin -->
                    @if(auth()->user()->rol !== 'admin')
                        <a href="{{ route('carritos.index') }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Ver Carrito
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('mensaje'))
                <div id="mensaje" class="mb-4 p-4 bg-green-500 text-white rounded">
                    {{ session('mensaje') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($productos as $producto)
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            {{ $producto->nombre }}
                        </h3>

                        <p class="text-gray-700 text-sm mb-4">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de producto" class="w-full h-48 object-cover rounded">
                        </p>

                        <p class="text-gray-700 text-sm mb-4">
                            {{ $producto->descripcion }}
                        </p>

                        <p class="text-indigo-600 font-semibold text-lg mb-4">
                            {{ number_format($producto->precio, 2) }} €
                        </p>

                        @auth
                            @if(auth()->user()->rol === 'cliente')
                                <form action="{{ route('carritos.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                    <input type="hidden" name="cantidad" value="1">
                                    <button type="submit" class="text-white bg-indigo-500 hover:bg-indigo-600 px-3 py-1 rounded text-sm">
                                        <i class="fas fa-cart-plus"></i> Añadir
                                    </button>
                                </form>
                            @endif
                        @endauth


                        @auth
                            @if(auth()->user()->rol === 'admin')
                                <div class="flex justify-between mt-4">
                                    <!-- Editar producto -->
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="text-green-500 hover:text-green-700">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>

                                    <!-- Borrar producto -->
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash-alt"></i> Borrar
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        @if(session('mensaje'))
        setTimeout(function() {
            const mensaje = document.getElementById('mensaje');
            if (mensaje) {
                mensaje.style.display = 'none';
            }
        }, 3000);
        @endif
    </script>
</x-app-layout>
