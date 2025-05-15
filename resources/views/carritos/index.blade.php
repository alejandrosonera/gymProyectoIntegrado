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
                            class="eliminar-unidad-form"
                            data-precio="{{ $item->producto->precio }}"
                            onsubmit="return false;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center bg-red-100 text-red-600 hover:bg-red-200 font-semibold px-3 py-1 rounded transition duration-200 shadow-sm">
                                <i class="fas fa-minus mr-1"></i> Eliminar 1
                            </button>
                        </form>

                        <!-- Botón Añadir 1 -->
                        <form action="{{ route('carritos.agregarUnidad', $item->id) }}" method="POST"
                            class="agregar-unidad-form"
                            data-precio="{{ $item->producto->precio }}"
                            onsubmit="return false;">
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

            <!-- Total del Carrito - Diseño Profesional -->
            <div class="mt-10 max-w-md mx-auto bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white rounded-lg shadow-lg p-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.105 0-2 .672-2 1.5S10.895 11 12 11s2-.672 2-1.5S13.105 8 12 8z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364l-1.414 1.414M7.05 16.95l-1.414 1.414m12.728 0l-1.414-1.414M7.05 7.05L5.636 5.636" />
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                    <div>
                        <p class="text-sm uppercase tracking-wider font-semibold opacity-90">Total a pagar</p>
                        <p id="total-carrito" class="text-3xl font-extrabold leading-none">{{ number_format($carrito->sum(fn($item) => $item->producto->precio * $item->cantidad), 2) }} €</p>
                    </div>
                </div>
                <button onclick="window.location='{{ route('pago.form') }}'"
                    class="bg-yellow-400 hover:bg-yellow-500 text-indigo-900 font-bold py-3 px-5 rounded-lg shadow-lg transition duration-300 flex items-center gap-2">
                    <i class="fas fa-credit-card"></i> Pagar Ahora
                </button>
            </div>

            @endif
        </div>
    </div>

    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('realizar-pedido-btn')?.addEventListener('click', function() {
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

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const totalSpan = document.getElementById("total-carrito");

        const actualizarTotal = (precio, operacion) => {
            let totalActual = parseFloat(totalSpan.textContent.replace(",", ".").replace(" €", ""));
            precio = parseFloat(precio);

            if (operacion === "sumar") {
                totalActual += precio;
            } else if (operacion === "restar") {
                totalActual -= precio;
                if (totalActual < 0) totalActual = 0;
            }

            totalSpan.textContent = totalActual.toFixed(2).replace(".", ",") + " €";
        };

        document.querySelectorAll(".agregar-unidad-form").forEach(form => {
            form.addEventListener("submit", function (e) {
                e.preventDefault();
                const precio = this.dataset.precio;

                fetch(this.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": this.querySelector('[name="_token"]').value,
                        "Accept": "application/json"
                    },
                }).then(response => {
                    if (response.ok) {
                        actualizarTotal(precio, "sumar");
                        location.reload(); // quita esta línea si quieres que no recargue
                    }
                });
            });
        });

        document.querySelectorAll(".eliminar-unidad-form").forEach(form => {
            form.addEventListener("submit", function (e) {
                e.preventDefault();
                const precio = this.dataset.precio;

                fetch(this.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": this.querySelector('[name="_token"]').value,
                        "X-HTTP-Method-Override": "DELETE",
                        "Accept": "application/json"
                    },
                }).then(response => {
                    if (response.ok) {
                        actualizarTotal(precio, "restar");
                        location.reload(); // quita esta línea si quieres que no recargue
                    }
                });
            });
        });
    });
    </script>

</x-app-layout>
