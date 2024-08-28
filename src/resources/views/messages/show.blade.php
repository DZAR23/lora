<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 leading-tight transition-opacity opacity-100 animate-fade-in">
            {{ __('Detalle del Mensaje') }}
        </h2>
    </x-slot>

    <div id="content-wrapper" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenedor principal con sombreado y bordes redondeados -->
            <div id="content" class="bg-white dark:bg-gray-900 shadow-lg rounded-lg p-6 lg:p-8 border border-gray-300 dark:border-gray-600 transition-opacity opacity-100 animate-fade-in">

                <div class="border border-gray-400 dark:border-gray-500 p-4 rounded-md bg-gray-100 dark:bg-gray-800">
                    <p class="text-lg mb-2">
                        <span class="font-bold text-gray-800 dark:text-gray-200">Número:</span>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $message->id }}</span>
                    </p>
                    <p class="text-lg mb-2">
                        <span class="font-bold text-gray-800 dark:text-gray-200">Remitente:</span>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $message->sender }}</span>
                    </p>
                    <p class="text-lg mb-2">
                        <span class="font-bold text-gray-800 dark:text-gray-200">Destinatario:</span>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $message->receiver }}</span>
                    </p>
                    <p class="text-lg mb-2">
                        <span class="font-bold text-gray-800 dark:text-gray-200">Fecha:</span>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                    </p>
                    <p class="text-lg mb-2">
                        <span class="font-bold text-gray-800 dark:text-gray-200">Contenido:</span>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $message->content }}</span>
                    </p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('messages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                        Volver a Listado de Mensajes
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Overlay de carga -->
    <div id="overlay" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="text-white text-xl">Cargando...</div>
    </div>

    <style>
        /* Animación de entrada suave */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.75s ease-out;
        }

        /* Animación de salida suave */
        @keyframes fade-out {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        .animate-fade-out {
            animation: fade-out 0.75s ease-in;
        }

        #overlay {
            display: none; /* Oculto por defecto */
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        #overlay.show {
            display: flex; /* Mostrar cuando sea necesario */
            opacity: 1;
        }
        #content-wrapper {
            transition: opacity 0.75s ease-in-out;
        }
        #content-wrapper.hide {
            opacity: 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const overlay = document.getElementById('overlay');
            const contentWrapper = document.getElementById('content-wrapper');

            // Función para mostrar el overlay
            function showOverlay() {
                overlay.classList.add('show');
                contentWrapper.classList.add('hide'); // Ocultar el contenido principal con animación
            }

            // Función para ocultar el overlay
            function hideOverlay() {
                overlay.classList.remove('show');
                contentWrapper.classList.remove('hide'); // Mostrar el contenido principal
            }

            // Manejar la transición de salida
            const links = document.querySelectorAll('a');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // Evitar la navegación por defecto
                    showOverlay();
                    setTimeout(() => {
                        window.location.href = this.href; // Navegar después de mostrar el overlay
                    }, 750); // Igualar a la duración de la animación
                });
            });

            // Ocultar el overlay cuando la nueva página se haya cargado
            window.addEventListener('load', function() {
                hideOverlay();
            });
        });
    </script>
</x-app-layout>
