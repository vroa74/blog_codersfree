<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generador de Códigos QR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Generar Código QR</h3>
                    
                    <form method="POST" action="{{ route('qr.generate') }}" class="mb-6">
                        @csrf
                        <div class="mb-4">
                            <label for="text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Texto o URL para el código QR:
                            </label>
                            <input type="text" 
                                   id="text" 
                                   name="text" 
                                   value="https://example.com"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                                   required>
                        </div>
                        
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Generar QR
                        </button>
                    </form>

                    <div class="mt-6">
                        <h4 class="text-md font-medium mb-2">Ejemplo de componentes Flowbite:</h4>
                        
                        <!-- Botón con Flowbite -->
                        <button type="button" 
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Botón Flowbite
                        </button>

                        <!-- Alerta con Flowbite -->
                        <div id="alert-1" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                Este es un ejemplo de alerta usando Flowbite.
                            </div>
                        </div>

                        <!-- Datepicker con Flowbite -->
                        <div class="mb-4">
                            <label for="datepicker" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Selector de fecha (Flowbite):
                            </label>
                            <input datepicker type="text" 
                                   id="datepicker"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                   placeholder="Seleccionar fecha">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
