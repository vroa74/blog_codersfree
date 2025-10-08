<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Usuario') }}: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Botones de acción -->
                    <div class="mb-6 flex justify-between items-center">
                        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            ← Volver a la Lista
                        </a>
                        <div class="flex space-x-2">
                            <a href="{{ route('users.edit', $user) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Editar Usuario
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Eliminar Usuario
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Información del usuario -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Información básica -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Información Básica</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ID:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->id }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Verificado:</dt>
                                    <dd class="text-sm">
                                        @if($user->email_verified_at)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                Verificado ({{ $user->email_verified_at->format('d/m/Y H:i') }})
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                No verificado
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Registro:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Última Actualización:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Información adicional -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Información Adicional</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">RFC:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->rfc ?? 'No especificado' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">CURP:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->curp ?? 'No especificado' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Sexo:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">
                                        @if($user->sexo == 'f')
                                            Femenino
                                        @elseif($user->sexo == 'm')
                                            Masculino
                                        @else
                                            No especificado
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nivel:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $user->nivel }} - 
                                        @switch($user->nivel)
                                            @case(1) Root @break
                                            @case(2) Super Admin @break
                                            @case(3) Administrador @break
                                            @case(4) Supervisor @break
                                            @case(5) Moderador @break
                                            @case(6) Editor @break
                                            @case(7) Usuario @break
                                            @default Desconocido
                                        @endswitch
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Puesto:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $user->puesto ?? 'No especificado' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Estatus:</dt>
                                    <dd class="text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->estatus ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                            {{ $user->estatus ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tema:</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">
                                        @if($user->theme == 'dark')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-800 text-white">
                                                Oscuro
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">
                                                Claro
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Información de autenticación -->
                    <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Información de Autenticación</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Autenticación de Dos Factores:</dt>
                                <dd class="text-sm text-gray-900 dark:text-gray-100">
                                    @if($user->two_factor_secret)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Habilitada
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                            Deshabilitada
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tokens API:</dt>
                                <dd class="text-sm text-gray-900 dark:text-gray-100">
                                    @if($user->tokens()->count() > 0)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $user->tokens()->count() }} token(s)
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                            Sin tokens
                                        </span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
