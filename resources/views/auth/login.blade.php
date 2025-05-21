<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 text-gray-800">

        <!-- Logo y título -->
        <div class="text-center mb-8">
            <img src="{{ asset('storage/logo.png') }}" alt="SoneGym Logo" class="w-20 h-20 mx-auto mb-2">
            <h1 class="text-3xl font-extrabold">Accede a <span class="text-yellow-500">SoneGym</span></h1>
            <p class="text-sm text-gray-600">Introduce tus credenciales para entrar</p>
        </div>

        <!-- Tarjeta de login -->
        <div class="w-full max-w-md bg-white text-gray-800 rounded-xl shadow-lg px-8 py-10">
            <x-validation-errors class="mb-4" />

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <x-label for="email" value="Correo electrónico" />
                    <x-input id="email" class="block mt-1 w-full rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="ejemplo@correo.com" />
                </div>

                <!-- Contraseña -->
                <div>
                    <x-label for="password" value="Contraseña" />
                    <x-input id="password" class="block mt-1 w-full rounded-lg shadow-sm" type="password" name="password" required autocomplete="current-password" placeholder="Tu contraseña" />
                </div>

                <!-- Recordarme -->
                <div class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <label for="remember_me" class="ml-2 text-sm text-gray-600 cursor-pointer">Recordarme</label>
                </div>

                <a href="{{ route('google.redirect') }}"
                    class="mt-4 inline-flex items-center justify-center w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <img src="https://developers.google.com/identity/images/g-logo.png" class="w-5 h-5 mr-2" alt="Google logo">
                    Iniciar sesión con Google
                </a>


                <!-- Botón y enlace -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6 gap-4">
                    @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:text-indigo-800 underline" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                    @endif

                    <x-button class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold px-6 py-2 rounded-lg shadow transition duration-200">
                        Entrar
                    </x-button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-500 mt-6">© {{ date('Y') }} SoneGym. Todos los derechos reservados.</p>
    </div>
</x-guest-layout>
