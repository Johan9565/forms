<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-[#691b31] to-[#8a1f3f] px-6 py-4">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">{{ __('Actualizar Contraseña') }}</h3>
                    <p class="text-red-100 text-sm">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form wire:submit="updatePassword" class="p-6 space-y-6">
            <!-- Current Password -->
            <div class="space-y-2">
                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Contraseña Actual') }}
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                                        <input
                        id="current_password"
                        type="password"
                        wire:model="state.current_password"
                        autocomplete="current-password"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#691b31] focus:border-[#691b31] dark:bg-gray-700 dark:text-white dark:focus:ring-[#8a1f3f] dark:focus:border-[#8a1f3f] transition-colors duration-200"
                        placeholder="Ingrese su contraseña actual"
                    >
                </div>
                <x-input-error for="current_password" class="mt-1" />
            </div>

            <!-- New Password -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Nueva Contraseña') }}
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                                        <input
                        id="password"
                        type="password"
                        wire:model="state.password"
                        autocomplete="new-password"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#691b31] focus:border-[#691b31] dark:bg-gray-700 dark:text-white dark:focus:ring-[#8a1f3f] dark:focus:border-[#8a1f3f] transition-colors duration-200"
                        placeholder="Ingrese su nueva contraseña"
                    >
                </div>
                <x-input-error for="password" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Confirmar Contraseña') }}
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                                        <input
                        id="password_confirmation"
                        type="password"
                        wire:model="state.password_confirmation"
                        autocomplete="new-password"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#691b31] focus:border-[#691b31] dark:bg-gray-700 dark:text-white dark:focus:ring-[#8a1f3f] dark:focus:border-[#8a1f3f] transition-colors duration-200"
                        placeholder="Confirme su nueva contraseña"
                    >
                </div>
                <x-input-error for="password_confirmation" class="mt-1" />
        </div>

            <!-- Password Requirements -->
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                            Requisitos de Contraseña
                        </h3>
                        <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Al menos 8 caracteres de largo</li>
                                <li>Incluya letras mayúsculas y minúsculas</li>
                                <li>Incluya al menos un número</li>
                                <li>Incluya al menos un carácter especial</li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                <x-action-message class="text-sm text-green-600 dark:text-green-400" on="saved">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ __('Contraseña actualizada correctamente!') }}
                    </div>
        </x-action-message>

                                <button
                    type="submit"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#691b31] to-[#8a1f3f] border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-[#5a1629] hover:to-[#7a1b35] focus:outline-none focus:ring-2 focus:ring-[#691b31] focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition-all duration-200 shadow-lg hover:shadow-xl"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Actualizar Contraseña') }}
                </button>
            </div>
        </form>
    </div>
</div>
