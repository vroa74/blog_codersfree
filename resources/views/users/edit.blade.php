<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuario') }}: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <x-label for="name" value="{{ __('Nombre') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-4">
                            <x-label for="password" value="{{ __('Nueva Contraseña') }}" />
                            <div class="relative">
                                <x-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" placeholder="Dejar vacío para mantener la actual" />
                                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg id="password-eye" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="password-eye-slash" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-4">
                            <x-label for="password_confirmation" value="{{ __('Confirmar Nueva Contraseña') }}" />
                            <div class="relative">
                                <x-input id="password_confirmation" class="block mt-1 w-full pr-10" type="password" name="password_confirmation" placeholder="Confirmar nueva contraseña" />
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg id="password_confirmation-eye" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="password_confirmation-eye-slash" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- RFC -->
                        <div class="mb-4">
                            <x-label for="rfc" value="{{ __('RFC') }}" />
                            <x-input id="rfc" class="block mt-1 w-full" type="text" name="rfc" value="{{ old('rfc', $user->rfc) }}" maxlength="14" placeholder="RFC (opcional)" />
                            @error('rfc')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CURP -->
                        <div class="mb-4">
                            <x-label for="curp" value="{{ __('CURP') }}" />
                            <x-input id="curp" class="block mt-1 w-full" type="text" name="curp" value="{{ old('curp', $user->curp) }}" maxlength="22" placeholder="CURP (opcional)" />
                            @error('curp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sexo -->
                        <div class="mb-4">
                            <x-label for="sexo" value="{{ __('Sexo') }}" />
                            <select id="sexo" name="sexo" class="block mt-1 w-full border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="">{{ __('Seleccionar sexo (opcional)') }}</option>
                                <option value="m" {{ old('sexo', $user->sexo) == 'm' ? 'selected' : '' }}>{{ __('Masculino') }}</option>
                                <option value="f" {{ old('sexo', $user->sexo) == 'f' ? 'selected' : '' }}>{{ __('Femenino') }}</option>
                            </select>
                            @error('sexo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nivel -->
                        <div class="mb-4">
                            <x-label for="nivel" value="{{ __('Nivel') }}" />
                            <select id="nivel" name="nivel" class="block mt-1 w-full border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="7" {{ old('nivel', $user->nivel) == 7 ? 'selected' : '' }}>7 - Usuario</option>
                                <option value="6" {{ old('nivel', $user->nivel) == 6 ? 'selected' : '' }}>6 - Editor</option>
                                <option value="5" {{ old('nivel', $user->nivel) == 5 ? 'selected' : '' }}>5 - Moderador</option>
                                <option value="4" {{ old('nivel', $user->nivel) == 4 ? 'selected' : '' }}>4 - Supervisor</option>
                                <option value="3" {{ old('nivel', $user->nivel) == 3 ? 'selected' : '' }}>3 - Administrador</option>
                                <option value="2" {{ old('nivel', $user->nivel) == 2 ? 'selected' : '' }}>2 - Super Admin</option>
                                <option value="1" {{ old('nivel', $user->nivel) == 1 ? 'selected' : '' }}>1 - Root</option>
                            </select>
                            @error('nivel')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Puesto -->
                        <div class="mb-4">
                            <x-label for="puesto" value="{{ __('Puesto') }}" />
                            <x-input id="puesto" class="block mt-1 w-full" type="text" name="puesto" value="{{ old('puesto', $user->puesto) }}" maxlength="70" placeholder="Puesto o cargo (opcional)" />
                            @error('puesto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estatus -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <x-checkbox id="estatus" name="estatus" value="1" :checked="old('estatus', $user->estatus)" />
                                <x-label for="estatus" value="{{ __('Usuario Activo') }}" class="ml-2" />
                            </div>
                            @error('estatus')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tema -->
                        <div class="mb-4">
                            <x-label for="theme" value="{{ __('Tema') }}" />
                            <select id="theme" name="theme" class="block mt-1 w-full border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="dark" {{ old('theme', $user->theme) == 'dark' ? 'selected' : '' }}>{{ __('Oscuro') }}</option>
                                <option value="light" {{ old('theme', $user->theme) == 'light' ? 'selected' : '' }}>{{ __('Claro') }}</option>
                            </select>
                            @error('theme')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2 inline-flex items-center">
                                <i class="ri-close-line mr-2"></i>
                                Cancelar
                            </a>
                            <x-button class="bg-indigo-600 hover:bg-indigo-700 inline-flex items-center">
                                <i class="ri-save-line mr-2"></i>
                                {{ __('Actualizar Usuario') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            const eyeSlashIcon = document.getElementById(fieldId + '-eye-slash');
            
            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                field.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>
