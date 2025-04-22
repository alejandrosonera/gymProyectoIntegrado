<x-self.base>
    @auth
        @if(Auth::user()->rol === 'entrenador')
            <x-button wire:click="$set('abrirCrear', true)"><i class="fas fa-add"></i>NUEVO</x-button>

            <x-dialog-modal wire:model="abrirCrear">
                <x-slot name="title">
                    Crear Clase
                </x-slot>
                <x-slot name="content">
                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-heading mr-1 text-orange-500"></i>Nombre
                        </label>
                        <input type="text" id="nombre" wire:model="cform.nombre" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>
                    <x-input-error for="cform.nombre" class="text-red-500" />

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-align-left mr-1 text-orange-500"></i>Descripción
                        </label>
                        <input type="text" id="descripcion" wire:model="cform.descripcion" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>
                    <x-input-error for="cform.descripcion" class="text-red-500" />

                    <!-- Fecha y hora -->
                    <div class="mb-4">
                        <label for="fecha_hora" class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-calendar-alt mr-1 text-orange-500"></i>Fecha y Hora
                        </label>
                        <input
                            type="datetime-local"
                            id="fecha_hora"
                            wire:model="cform.fecha_hora"
                            min="{{ date('Y-m-d\TH:i') }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                    </div>
                    <x-input-error for="cform.fecha_hora" class="text-red-500" />

                    <!-- Máximo de participantes -->
                    <div class="mb-6">
                        <label for="max_participantes" class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-users mr-1 text-orange-500"></i>Máx. Participantes
                        </label>
                        <input type="number" id="max_participantes" wire:model="cform.max_participantes" min="1" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>
                    <x-input-error for="cform.max_participantes" class="text-red-500" />
                </x-slot>
                <x-slot name="footer">
                    <div class="flex justify-between space-x-2">
                        <button type="reset" class="w-1/3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 rounded">
                            <i class="fas fa-rotate-left mr-1"></i>Resetear
                        </button>
                        <button wire:click="store" type="submit" class="w-1/3 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded">
                            <i class="fas fa-paper-plane mr-1"></i>Enviar
                        </button>
                        <button wire:click="cancelar" class="w-1/3 text-center bg-red-500 hover:bg-red-600 text-white font-semibold py-2 rounded">
                            <i class="fas fa-times mr-1"></i>Cancelar
                        </button>
                    </div>
                </x-slot>
            </x-dialog-modal>
        @endif
    @endauth
</x-self.base>
