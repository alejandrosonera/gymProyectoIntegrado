<nav x-data="{ open: false }" class="bg-[#f3f4f6] border-b border-[#cbd5e1]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('inicio') }}">
                    <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="h-14 w-auto">
                </a>


                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('showclases') }}" :active="request()->routeIs('showclases')" class="text-[#1f2937] hover:bg-[#e5e7eb] px-3 py-2 rounded-md transition">
                        {{ __('CLASES') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('tienda.index') }}" :active="request()->routeIs('tienda.index')" class="text-[#1f2937] hover:bg-[#e5e7eb] px-3 py-2 rounded-md transition">
                        {{ __('TIENDA') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Auth/Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-[#cbd5e1] transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">Gestión de cuenta</div>
                            <x-dropdown-link href="{{ route('profile.show') }}">Perfil</x-dropdown-link>
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">API Tokens</x-dropdown-link>
                            @endif
                            <div class="border-t border-gray-200"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    Cerrar sesión
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @else
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}" class="text-[#1f2937] border border-transparent hover:border-[#cbd5e1] px-4 py-1.5 rounded-md text-sm transition">Iniciar sesión</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-[#1f2937] border border-[#cbd5e1] hover:bg-[#e5e7eb] px-4 py-1.5 rounded-md text-sm transition">Registrarse</a>
                    @endif
                </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#6b7280] hover:text-[#1f2937] hover:bg-[#e5e7eb] focus:outline-none transition">
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

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="sm:hidden hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('showclases') }}" :active="request()->routeIs('showclases')">
                {{ __('CLASES') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('tienda.index') }}" :active="request()->routeIs('tienda.index')">
                {{ __('TIENDA') }}
            </x-responsive-nav-link>
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 me-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
                @endif
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
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
