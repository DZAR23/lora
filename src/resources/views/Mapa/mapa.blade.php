<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-opacity opacity-100 animate-fade-in">
            {{ __('Mapa de Conductores') }}
        </h2>
    </x-slot>

    <div id="content-wrapper" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="content" class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8 border border-gray-200 dark:border-gray-700 transition-opacity opacity-100 animate-fade-in">
                <!-- Contenedor para el iframe del mapa de Google -->
                <div class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden shadow-md">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31598.80303387833!2d-79.04067198672898!3d-8.11671264649899!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ad3d7fe3fae92d%3A0xd3bc7d125d4e8508!2sTrujillo!5e0!3m2!1ses-419!2spe!4v1724694868224!5m2!1ses-419!2spe" 
                            width="100%" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay de carga -->
    <div id="overlay" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="text-white text-lg">Cargando...</div>
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
                    if (this.href) { // Verificar si el enlace tiene una URL
                        e.preventDefault(); // Evitar la navegación por defecto
                        showOverlay();
                        setTimeout(() => {
                            window.location.href = this.href; // Navegar después de mostrar el overlay
                        }, 750); // Igualar a la duración de la animación
                    }
                });
            });

            // Ocultar el overlay cuando la nueva página se haya cargado
            window.addEventListener('load', function() {
                hideOverlay();
            });
        });
    </script>
</x-app-layout>