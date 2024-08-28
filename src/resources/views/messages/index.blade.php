<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-opacity opacity-100 animate-fade-in">
            {{ __('Listado de Mensajes') }}
        </h2>
    </x-slot>

    <div id="content-wrapper" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenedor principal con sombreado y bordes redondeados -->
            <div id="content" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 lg:p-8 border border-gray-200 dark:border-gray-700 transition-opacity opacity-100 animate-fade-in">
                
                <!-- Botón para enviar un nuevo mensaje -->
                <div class="mb-4 flex justify-end">
                    <a href="{{ route('messages.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                        Enviar un Mensaje
                    </a>
                </div>
                
                <!-- Tabla con lista de mensajes -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Encabezado de la tabla -->
                        <thead class="bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400 uppercase text-xs font-medium">
                            <tr>
                                <th class="px-4 py-3 text-left">Número</th>
                                <th class="px-4 py-3 text-left">Remitente</th>
                                <th class="px-4 py-3 text-left">Fecha</th>
                                <th class="px-4 py-3 text-left">Vista Previa</th>
                                <th class="px-4 py-3 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <!-- Cuerpo de la tabla -->
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($messages as $message)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $message->id }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $message->sender }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 truncate max-w-xs">{{ \Illuminate\Support\Str::limit($message->content, 50) }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        <a href="{{ route('messages.show', $message->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                                            Ver Detalle
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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