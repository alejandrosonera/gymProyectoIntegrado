<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script>
        Livewire.on('mensaje', txt => {
            Swal.fire({
                icon: "success",
                title: txt,
                showConfirmButton: false,
                timer: 1500
            });
        })
        Livewire.on('onBorrarClase', id => {
            Swal.fire({
                title: "Estas seguro?",
                text: "No podras revertir esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, quiero borrarla!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatchTo('clase', 'borrarOk', id)
                }
            });
        })
    </script>

    @if(session('showTempPassword'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: '¡Cuenta creada!',
                html: `
                    <p>Has iniciado sesión correctamente con tu cuenta de Google.</p>
                    <p><strong>Esta es tu contraseña temporal:</strong></p>
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <input type="text" id="tempPassword" value="{{ session('showTempPassword') }}" readonly style="border:none; background:#f1f1f1; padding:5px; width:80%; text-align:center;" />
                        <button onclick="copyPassword()" style="margin-left: 10px; padding:5px;">📋</button>
                    </div>
                    <p style="margin-top:10px;">Te recomendamos cambiarla desde tu perfil lo antes posible.</p>
                `,
                icon: 'info',
                confirmButtonText: 'Entendido'
            });
        });

        function copyPassword() {
            const input = document.getElementById("tempPassword");
            input.select();
            input.setSelectionRange(0, 99999);
            document.execCommand("copy");

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Contraseña copiada al portapapeles',
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
    @endif

</body>

</html>
