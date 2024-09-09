<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-opacity opacity-100 animate-fade-in">
            {{ __('Lista de Conductores') }}
        </h2>
    </x-slot>

    <div id="content-wrapper" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenedor principal con sombreado y bordes redondeados -->
            <div id="content" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 lg:p-8 border border-gray-200 dark:border-gray-700 transition-opacity opacity-100 animate-fade-in">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 mb-6">

                    <!-- Formulario de búsqueda -->
                    <div class="mb-4">
                        <form action="{{ route('Conductore.index') }}" method="GET">
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request()->query('search') }}" 
                                    placeholder="Buscar conductor por número, nombre, correo o teléfono..." 
                                    class="px-4 py-2 w-full focus:outline-none"
                                >
                                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4">
                                    Buscar
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Mensaje de búsqueda -->
                    @if (session('search_message'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('search_message') }}
                        </div>
                    @endif

                    <!-- Botón para crear un nuevo conductor -->
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('Conductore.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                            Crear Conductor
                        </a>
                    </div>

                    <!-- Tabla con lista de conductores -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Encabezado de la tabla -->
                            <thead class="bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400 uppercase text-xs font-medium">
                                <tr>
                                    <th class="px-4 py-3 text-left">ID</th>
                                    <th class="px-4 py-3 text-left">Imagen</th>
                                    <th class="px-4 py-3 text-left">Nombre</th>
                                    <th class="px-4 py-3 text-left">Móvil</th>
                                    <th class="px-4 py-3 text-left">Categoría</th>
                                    <th class="px-4 py-3 text-left">Correo</th>
                                    <th class="px-4 py-3 text-left">Teléfono</th>
                                    <th class="px-4 py-3 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <!-- Cuerpo de la tabla -->
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach ($conductores as $conductor)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                                        <td class="px-4 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $conductor->id }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 text-center">
                                            @if ($conductor->imagen)
                                                <img src="{{ asset('storage/' . $conductor->imagen) }}" alt="Imagen de conductor" class="w-16 h-16 object-cover rounded-full border border-gray-300 dark:border-gray-600">
                                            @else
                                                No disponible
                                            @endif 
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $conductor->name }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $conductor->movil }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $conductor->categoria }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $conductor->email }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $conductor->telefono }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                            <div class="flex space-x-2 justify-center">
                                                <a href="{{ route('Conductore.edit', $conductor->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                                                    Editar
                                                </a>
                                                <form action="{{ route('Conductore.destroy', $conductor->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este conductor?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

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
