<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight transition-opacity opacity-100 animate-fade-in">
            {{ __('Editar Conductor') }}
        </h2>
    </x-slot>

    <div id="content-wrapper" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="content" class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8 border border-gray-200 dark:border-gray-700 transition-opacity opacity-100 animate-fade-in">

                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 text-red-700 border border-red-300 rounded-lg p-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario para editar el conductor -->
                <form action="{{ route('Conductore.update', $conductore->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Campo para imagen -->
                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagen</label>
                        <input type="file" name="image" id="image" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                        @if($conductore->imagen)
                            <img src="{{ asset('storage/' . $conductore->imagen) }}" alt="Imagen del conductor" class="mt-2 w-32 h-auto object-cover rounded-lg border border-gray-300 dark:border-gray-600"> 
                        @endif
                    </div>

                    <!-- Campo para nombre -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $conductore->name) }}" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required>
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo para número móvil -->
                    <div>
                        <label for="movil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número Móvil</label>
                        <input type="number" name="movil" id="movil" value="{{ old('movil', $conductore->movil) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required>
                        @error('movil')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo para categoría -->
                    <div>
                        <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                        <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $conductore->categoria) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required>
                        @error('categoria')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo para correo electrónico -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $conductore->email) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required>
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo para número de teléfono -->
                    <div>
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de Teléfono</label>
                        <input type="number" name="telefono" id="telefono" value="{{ old('telefono', $conductore->telefono) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required>
                        @error('telefono')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="submit" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                            Actualizar
                        </button>
                        <a href="{{ route('Conductore.index') }}" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            Cancelar
                        </a>
                    </div>
                </form>

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