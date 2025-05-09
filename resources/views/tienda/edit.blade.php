<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <i class="fas fa-edit mr-2 text-indigo-600"></i> Editar Producto
        </h2>
    </x-slot>

    {{-- FontAwesome --}}
    <x-slot name="head">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" crossorigin="anonymous"></script>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-tag mr-2 text-indigo-500"></i>Nombre
                    </label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-align-left mr-2 text-indigo-500"></i>Descripción
                    </label>
                    <textarea id="descripcion" name="descripcion" rows="4"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="precio" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-euro-sign mr-2 text-indigo-500"></i>Precio (€)
                    </label>
                    <input type="number" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" step="0.01"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-boxes mr-2 text-indigo-500"></i>Stock
                    </label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" min="0"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label for="imagen" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-image mr-2 text-indigo-500"></i>Imagen del producto
                    </label>
                    <input type="file" id="imagen" name="imagen" accept="image/*"
                        class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        onchange="previewImage(event)">

                    <div id="preview-container" class="mt-2 hidden">
                        <img id="preview" src="" alt="Vista previa de la imagen" class="w-32 h-32 object-cover border rounded shadow mx-auto">
                    </div>

                    <!-- Mostrar la imagen actual si existe -->
                    @if($producto->imagen)
                    <div class="mt-4">
                        <label class="block text-gray-700 font-bold mb-2">Imagen actual</label>
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto"
                            class="w-32 h-32 object-cover border rounded shadow mx-auto">
                    </div>
                    @endif
                </div>

                <div class="flex flex-col sm:flex-row justify-between">
                    <a href="{{ route('tienda.index') }}"
                        class="mb-2 sm:mb-0 inline-flex items-center justify-center px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Cancelar
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        <i class="fas fa-save mr-2"></i> Guardar producto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const container = document.getElementById('preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
