<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md shadow border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo y enlaces -->
            <div class="flex items-center gap-10">
                <a href="{{ route('inicio') }}">
                    <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="h-12 w-auto">
                </a>
                <div class="hidden sm:flex gap-6">
                    <x-nav-link href="{{ route('showclases') }}" :active="request()->routeIs('showclases')" class="text-gray-700 hover:text-blue-600 hover:bg-gray-100 px-3 py-2 rounded-lg transition font-medium">
                        {{ __('CLASES') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('tienda.index') }}" :active="request()->routeIs('tienda.index')" class="text-gray-700 hover:text-blue-600 hover:bg-gray-100 px-3 py-2 rounded-lg transition font-medium">
                        {{ __('TIENDA') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Auth -->
            <div class="hidden sm:flex items-center gap-4">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
                            <img class="h-9 w-9 rounded-full object-cover border border-gray-300" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-2 text-sm text-gray-500">Gestión de cuenta</div>
                        <x-dropdown-link href="{{ route('profile.show') }}">Perfil</x-dropdown-link>
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">API Tokens</x-dropdown-link>
                        @endif
                        <hr class="my-1 border-gray-200">
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                Cerrar sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 hover:bg-gray-100 px-4 py-2 rounded-lg text-sm transition">Iniciar sesión</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-blue-600 border border-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm transition">Registrarse</a>
                @endif
                @endauth
            </div>

            <!-- Botón hamburguesa -->
            <div class="flex sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-600 hover:text-blue-600 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div :class="{'block': open, 'hidden': !open}" class="sm:hidden hidden px-4 pb-4">
        <div class="pt-3 space-y-2">
            <x-responsive-nav-link href="{{ route('showclases') }}" :active="request()->routeIs('showclases')">
                {{ __('CLASES') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('tienda.index') }}" :active="request()->routeIs('tienda.index')">
                {{ __('TIENDA') }}
            </x-responsive-nav-link>
        </div>

        @auth
        <div class="pt-4 border-t border-gray-200 mt-4">
            <div class="flex items-center gap-3 px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                @endif
                <div>
                    <div class="font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">Perfil</x-responsive-nav-link>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">API Tokens</x-responsive-nav-link>
                @endif
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        Cerrar sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
