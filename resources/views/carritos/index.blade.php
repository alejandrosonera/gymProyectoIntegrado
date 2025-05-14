<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🛒 Mi Carrito
            </h2>
            <a href="{{ route('productos.index') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded shadow-md transition duration-300">
                🏪 Volver a la Tienda
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('mensaje'))
            <div class="mb-6 p-4 bg-green-500 text-white rounded shadow">
                {{ session('mensaje') }}
            </div>
            @endif

            @if ($carrito->isEmpty())
            <div class="text-center text-gray-600 text-lg">
                <i class="fas fa-shopping-cart text-4xl mb-4"></i>
                <p>No hay productos en tu carrito.</p>
            </div>
            @else

            <!-- Botón Vaciar Carrito -->
            <div class="mb-6">
                <form action="{{ route('carritos.vaciar') }}" method="POST"
                    onsubmit="return confirm('¿Estás seguro de que quieres vaciar el carrito?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded shadow-md transition duration-300">
                        🗑️ Vaciar Carrito
                    </button>
                </form>
            </div>

            <!-- Lista de Productos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($carrito as $item)
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300 flex flex-col justify-between h-full">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->producto->nombre }}</h3>
                        <p class="text-gray-600 mb-1">💶 <strong>Precio:</strong> {{ number_format($item->producto->precio, 2) }} €</p>
                        <p class="text-gray-600 mb-4">🔢 <strong>Cantidad:</strong> {{ $item->cantidad }}</p>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-auto">
                        <!-- Botón Eliminar 1 -->
                        <form action="{{ route('carritos.eliminarUnidad', $item->id) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar una unidad de este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center bg-red-100 text-red-600 hover:bg-red-200 font-semibold px-3 py-1 rounded transition duration-200 shadow-sm">
                                <i class="fas fa-minus mr-1"></i> Eliminar 1
                            </button>
                        </form>

                        <!-- Botón Añadir 1 -->
                        <form action="{{ route('carritos.agregarUnidad', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center bg-green-100 text-green-600 hover:bg-green-200 font-semibold px-3 py-1 rounded transition duration-200 shadow-sm">
                                <i class="fas fa-plus mr-1"></i> Añadir 1
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Botón Realizar Pedido -->
            <form id="realizar-pedido-form" action="{{ route('pedidos.store') }}" method="POST" class="text-center mt-10">
                @csrf
                <button type="button" id="realizar-pedido-btn"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded shadow-lg transition duration-300">
                    <i class="fas fa-check-circle mr-2"></i> Realizar Pedido
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('realizar-pedido-btn')?.addEventListener('click', function () {
            Swal.fire({
                title: '¿Confirmar Pedido?',
                text: "¿Deseas finalizar y realizar este pedido?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, realizar pedido',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('realizar-pedido-form').submit();
                }
            });
        });
    </script>
</x-app-layout>
