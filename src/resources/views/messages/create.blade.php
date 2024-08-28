<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-opacity opacity-100 animate-fade-in">
            {{ __('Enviar Mensaje') }}
        </h2>
    </x-slot>

    <div id="content-wrapper" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenedor principal con sombreado y bordes redondeados -->
            <div id="content" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 lg:p-8 border border-gray-200 dark:border-gray-700 transition-opacity opacity-100 animate-fade-in">
                <!-- Mensaje de éxito -->
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulario de envío de mensajes -->
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf

                    <!-- Campo para el correo electrónico del destinatario -->
                    <div class="mb-4">
                        <label for="receiver_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Correo del Destinatario
                        </label>
                        <input type="email" id="receiver_email" name="receiver_email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        @error('receiver_email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campo para el contenido del mensaje -->
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Contenido del Mensaje
                        </label>
                        <textarea id="content" name="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botón para enviar el mensaje -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                            Enviar Mensaje
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
