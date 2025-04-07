<x-self.base>
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow overflow-hidden">
        <div class="px-4 py-5 sm:px-6 bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                Horario de Clases del Gimnasio
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                Consulta las clases disponibles y sus detalles.
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
            @foreach ($clases as $clase)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="px-4 py-4">
                    <h3 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-2">
                        {{ $clase->nombre }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                        {{ Str::limit($clase->descripcion, 80) }}
                    </p>
                    <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mb-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ \Carbon\Carbon::parse($clase->fecha_hora)->format('d/m/Y H:i') }}
                    </div>
                    <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mb-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Entrenador: {{ $clase->entrenador->name ?? 'Sin asignar' }} {{ $clase->entrenador->apellido ?? '' }}
                    </div>
                    <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10-4a2 2 0 100-4 2 2 0 000 4zm-4 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Participantes: {{ $clase->participantes_actuales ?? 0 }} / {{ $clase->max_participantes }}
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right">
                    <a href="#" class="inline-flex items-center px-3 py-2 border border-indigo-500 dark:border-indigo-400 rounded-md shadow-sm text-sm font-medium text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-800 hover:bg-indigo-50 dark:hover:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                        Ver Detalles
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-self.base>