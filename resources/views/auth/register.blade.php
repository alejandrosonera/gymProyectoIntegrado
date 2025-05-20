<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 text-gray-800">

        <!-- Logo y título -->
        <div class="text-center mb-8">
            <img src="{{ asset('storage/logo.png') }}" alt="SoneGym Logo" class="w-20 h-20 mx-auto mb-2">
            <h1 class="text-3xl font-extrabold">Únete a <span class="text-yellow-500">SoneGym</span></h1>
            <p class="text-sm text-gray-600">Crea tu cuenta y empieza tu camino fitness</p>
        </div>

        <!-- Tarjeta de registro -->
        <div class="w-full max-w-2xl bg-white text-gray-800 rounded-xl shadow-lg px-8 py-10">
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Nombre -->
                <div>
                    <x-label for="name" value="Nombre completo" />
                    <x-input id="name" class="block mt-1 w-full rounded-lg shadow-sm" type="text" name="name" :value="old('name')" required autofocus placeholder="Ej: Juan Pérez" />
                </div>

                <!-- Email -->
                <div>
                    <x-label for="email" value="Correo electrónico" />
                    <x-input id="email" class="block mt-1 w-full rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required placeholder="ejemplo@correo.com" />
                </div>

                <!-- Contraseña -->
                <div>
                    <x-label for="password" value="Contraseña" />
                    <x-input id="password" class="block mt-1 w-full rounded-lg shadow-sm" type="password" name="password" required placeholder="Mínimo 8 caracteres" />
                </div>

                <!-- Confirmar contraseña -->
                <div>
                    <x-label for="password_confirmation" value="Confirmar contraseña" />
                    <x-input id="password_confirmation" class="block mt-1 w-full rounded-lg shadow-sm" type="password" name="password_confirmation" required placeholder="Repite tu contraseña" />
                </div>

                <!-- Rol -->
                <div>
                    <x-label for="rol" value="Selecciona tu rol" />
                    <select id="rol" name="rol" required
                        class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50">
                        <option value="" disabled selected>-- Elige un rol --</option>
                        <option value="entrenador" {{ old('rol') == 'entrenador' ? 'selected' : '' }}>Entrenador</option>
                        <option value="cliente" {{ old('rol') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                    </select>

                    <!-- Términos -->
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="text-sm text-gray-600 mt-2">
                        <label for="terms" class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <span class="ml-2">
                                {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-indigo-600 hover:text-indigo-800">'.__('términos de servicio').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-indigo-600 hover:text-indigo-800">'.__('política de privacidad').'</a>',
                                ]) !!}
                            </span>
                        </label>
                    </div>
                    @endif

                    <!-- Botón y enlace -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6 gap-4">
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 underline" href="{{ route('login') }}">
                            ¿Ya tienes cuenta?
                        </a>

                        <x-button class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold px-6 py-2 rounded-lg shadow transition duration-200">
                            Registrarme
                        </x-button>
                    </div>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-500 mt-6">© {{ date('Y') }} SoneGym. Todos los derechos reservados.</p>
    </div>
</x-guest-layout>
