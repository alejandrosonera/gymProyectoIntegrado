<div class="bg-white dark:bg-gray-900 rounded-lg shadow-xl overflow-hidden mx-auto max-w-7xl p-6">
    <!-- Título y descripción -->
    <div class="px-6 py-5 sm:px-8 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-800 border-b border-gray-200 dark:border-gray-700 rounded-lg">
        <h2 class="text-4xl font-semibold text-white leading-tight text-center">
            Horario de Clases del Gimnasio
        </h2>
        <p class="mt-2 text-lg text-gray-200 text-center">
            Consulta las clases disponibles y sus detalles.
        </p>
    </div>
    <!-- Buscador y crear clase -->
    <div class="flex justify-between items-center mt-6">
        <div>
            <x-input type="search" wire:model.live="buscar" placeholder="Buscar clases..." class="mt-4" />
        </div>
        <div>
            @livewire('crear-clase')
        </div>
    </div>
    @if($clases->count())
    <!-- Grid de clases -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
        @foreach ($clases as $clase)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <div class="px-6 py-6">
                <!-- Nombre de la clase -->
                <h3 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400 mb-4 text-center">
                    {{ $clase->nombre }}
                </h3>
                <!-- Descripción -->
                <p class="text-gray-700 dark:text-gray-300 text-sm mb-4">
                    {{ Str::limit($clase->descripcion, 90) }}
                </p>
                <!-- Detalles -->
                <div class="flex items-center text-gray-600 dark:text-gray-400 text-sm mb-3">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ \Carbon\Carbon::parse($clase->fecha_hora)->format('d/m/Y H:i') }}
                </div>
                <div class="flex items-center text-gray-600 dark:text-gray-400 text-sm mb-3">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Entrenador: {{ $clase->entrenador->name ?? 'Sin asignar' }} {{ $clase->entrenador->apellido ?? '' }}
                </div>
                <div class="flex items-center text-gray-600 dark:text-gray-400 text-sm mb-3">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10-4a2 2 0 100-4 2 2 0 000 4zm-4 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Participantes: {{ $clase->clientes->count() }} / {{ $clase->max_participantes }}
                </div>
            </div>
            <!-- Acciones del entrenador -->
            @if (Auth::user()->id === $clase->entrenador_id)
            <div class="flex justify-between px-6 py-3 bg-gray-50 dark:bg-gray-700">
                <button wire:click="edit({{ $clase->id }})" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 transition-all">
                    <i class="fas fa-edit text-green-500 hover:text-xl"></i>
                </button>
                <button wire:click="confirmarDelete({{ $clase->id }})" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 transition-all">
                    <i class="fas fa-trash text-red-500 hover:text-xl"></i>
                </button>
                <!-- Botón para ver los usuarios apuntados (solo para administradores) -->
                @if (Auth::user()->rol === 'entrenador')
                <button wire:click="verUsuariosApuntados({{ $clase->id }})" class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-200 transition-all">
                    <i class="fas fa-users text-yellow-500 hover:text-xl"></i>
                </button>
                @endif
            </div>
            @endif
            <!-- Lógica para apuntarse/desapuntarse -->
            @auth
            @if (Auth::user()->rol === 'cliente')
                @if (!$clase->clientes->contains(auth()->id()) && $clase->clientes->count() < $clase->max_participantes)
                    <div class="px-6 py-4 bg-indigo-100 dark:bg-indigo-800">
                        <!-- Verificar si hay conflicto de horario -->
                        @php
                            $tieneConflicto = false;
                            $claseConflicto = null;

                            // Obtener solo las clases a las que el usuario está apuntado
                            $clasesUsuario = App\Models\Clase::whereHas('clientes', function($query) {
                                $query->where('user_id', Auth::id());
                            })->get();

                            // Convertir la fecha de la clase actual a un objeto Carbon para comparación
                            $fechaClaseActual = \Carbon\Carbon::parse($clase->fecha_hora);

                            foreach ($clasesUsuario as $claseUsuario) {
                                // Convertir la fecha de la clase del usuario a un objeto Carbon
                                $fechaClaseUsuario = \Carbon\Carbon::parse($claseUsuario->fecha_hora);

                                // Solo verificar conflicto si es el mismo día y no es la misma clase
                                if ($fechaClaseActual->isSameDay($fechaClaseUsuario) && $clase->id != $claseUsuario->id) {
                                    $tieneConflicto = true;
                                    $claseConflicto = $claseUsuario;
                                    break;
                                }
                            }
                        @endphp

                        @if ($tieneConflicto)
                            <div class="mb-2 text-sm text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900 p-2 rounded-md">
                                <p>No puedes apuntarte a esta clase porque ya estás inscrito en "{{ $claseConflicto->nombre }}" el mismo día
                                ({{ \Carbon\Carbon::parse($claseConflicto->fecha_hora)->format('d/m/Y') }})
                                a las {{ \Carbon\Carbon::parse($claseConflicto->fecha_hora)->format('H:i') }}.</p>
                            </div>
                            <button
                                class="inline-flex items-center px-6 py-3 border border-gray-400 rounded-md text-sm font-medium text-gray-400 bg-gray-100 dark:bg-gray-700 cursor-not-allowed w-full justify-center"
                                disabled
                            >
                                No disponible - Ya tienes una clase este día
                            </button>
                        @else
                            <button
                                wire:click="apuntarse({{ $clase->id }})"
                                class="inline-flex items-center px-6 py-3 border border-indigo-600 dark:border-indigo-400 rounded-md text-sm font-medium text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-800 hover:bg-indigo-200 dark:hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition duration-300 w-full justify-center"
                            >
                                Apuntarse a la Clase
                            </button>
                        @endif
                    </div>
                @elseif ($clase->clientes()->where('user_id', auth()->id())->exists())
                    <div class="px-6 py-4 bg-indigo-100 dark:bg-indigo-800 text-right">
                        <button wire:click="desapuntarse({{ $clase->id }})" class="inline-flex items-center px-6 py-3 border border-red-600 dark:border-red-400 rounded-md text-sm font-medium text-red-600 dark:text-red-400 bg-white dark:bg-gray-800 hover:bg-red-200 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-red-400 transition duration-300 w-full justify-center">
                            Desapuntarse de la Clase
                        </button>
                    </div>
                @elseif ($clase->clientes()->count() >= $clase->max_participantes)
                    <div class="px-6 py-4 bg-indigo-100 dark:bg-indigo-800 text-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400 bg-gray-200 dark:bg-gray-700 p-2 rounded-md inline-block">
                            No hay espacio disponible en esta clase.
                        </span>
                    </div>
                @endif
            @endif
            @else
                <div class="px-6 py-4 bg-indigo-100 dark:bg-indigo-800 text-right">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-indigo-600 dark:border-indigo-400 rounded-md text-sm font-medium text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-800 hover:bg-indigo-200 dark:hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition duration-300">
                        Inicia sesión para apuntarte
                    </a>
                </div>
            @endauth
        </div>
        @endforeach
    </div>
    <!-- Paginación centrada -->
    <div class="text-center py-6 mt-6">
        {{$clases->links()}}
    </div>
    @else
    <div class="mt-6">
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 px-6 py-4 rounded-lg shadow-md dark:bg-yellow-200 dark:text-yellow-900 animate-fade-in">
            <p class="font-medium flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 18.5a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                </svg>
                No se encontró ninguna clase con la búsqueda proporcionada.
            </p>
        </div>
    </div>
    @endif
    <!-- Modal para ver los usuarios apuntados -->
    @if (!empty($usuariosApuntados) && $showModal)
    <div class="fixed inset-0 flex items-center justify-center z-50 p-4 bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl p-6">
            <div class="flex justify-between items-center">
                <h2 class="text-3xl font-semibold text-indigo-600 dark:text-indigo-400">
                    Participantes en la Clase
                </h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="mt-4">
                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                    @if ($clase->clientes->count() > 0)
                    <ul class="space-y-3">
                        @foreach ($clase->clientes as $cliente)
                        <li class="flex items-center justify-between p-2 bg-white dark:bg-gray-600 rounded-md shadow-sm">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $cliente->name }} {{ $cliente->apellido }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($cliente->pivot->created_at)->format('d/m/Y H:i') }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-center text-gray-600 dark:text-gray-400">No hay participantes en esta clase.</p>
                    @endif
                </div>
            </div>
            <div class="mt-6 text-center">
                <button wire:click="closeModal" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
