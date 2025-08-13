<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-[#691b31] to-[#8a1f3f] px-6 py-4">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">{{ __('Información de Perfil') }}</h3>
                    <p class="text-red-100 text-sm">{{ __('Actualiza la información de tu perfil y dirección de correo electrónico.') }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form wire:submit="updateProfileInformation" class="p-6 space-y-6">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="space-y-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('Foto de Perfil') }}
                    </label>

                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="hidden"
                                wire:model.live="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();z
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />

                    <!-- Photo Display Section -->
                    <div class="flex items-center space-x-6">
                        <!-- Current Profile Photo -->
                        <div x-show="! photoPreview" class="flex-shrink-0">
                            <div class="relative">
                                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                                     class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 dark:border-gray-600 shadow-lg">
                                <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-green-400 rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div x-show="photoPreview" style="display: none;" class="flex-shrink-0">
                            <div class="relative">
                                <span class="block w-24 h-24 rounded-full bg-cover bg-no-repeat bg-center border-4 border-blue-200 dark:border-blue-600 shadow-lg"
                                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                                <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-blue-400 rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Actions -->
                        <div class="flex flex-col space-y-2">
                            <button type="button"
                                    x-on:click.prevent="$refs.photo.click()"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#691b31] to-[#8a1f3f] border border-transparent rounded-lg font-medium text-sm text-white hover:from-[#5a1629] hover:to-[#7a1b35] focus:outline-none focus:ring-2 focus:ring-[#691b31] focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ __('Seleccionar una nueva foto') }}
                            </button>

                            @if ($this->user->profile_photo_path)
                                <button type="button"
                                        wire:click="deleteProfilePhoto"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 shadow-md hover:shadow-lg">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    {{ __('Eliminar foto') }}
                                </button>
                            @endif
                        </div>
                    </div>

                    <x-input-error for="photo" class="mt-2" />
                </div>
            @endif

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Nombre Completo') }}
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input
                        id="name"
                        type="text"
                        wire:model="state.name"
                        required
                        autocomplete="name"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#691b31] focus:border-[#691b31] dark:bg-gray-700 dark:text-white dark:focus:ring-[#8a1f3f] dark:focus:border-[#8a1f3f] transition-colors duration-200"
                        placeholder="Ingrese su nombre completo"
                    >
                </div>
                <x-input-error for="name" class="mt-1" />
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Dirección de Correo Electrónico') }}
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <input
                        id="email"
                        type="email"
                        wire:model="state.email"
                        required
                        autocomplete="username"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#691b31] focus:border-[#691b31] dark:bg-gray-700 dark:text-white dark:focus:ring-[#8a1f3f] dark:focus:border-[#8a1f3f] transition-colors duration-200"
                        placeholder="Ingrese su dirección de correo electrónico"
                    >
                </div>
                <x-input-error for="email" class="mt-1" />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                    {{ __('Verificación de Correo Electrónico Requerida') }}
                                </h3>
                                <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                    <p>{{ __('Su dirección de correo electrónico no está verificada.') }}</p>
                                    <button type="button"
                                            class="mt-2 text-[#691b31] dark:text-[#8a1f3f] hover:text-[#5a1629] dark:hover:text-[#7a1b35] font-medium underline focus:outline-none focus:ring-2 focus:ring-[#691b31] focus:ring-offset-2 dark:focus:ring-offset-gray-800 rounded"
                                            wire:click.prevent="sendEmailVerification">
                                        {{ __('Haga clic aquí para reenviar el correo de verificación.') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($this->verificationLinkSent)
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                        {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                <x-action-message class="text-sm text-green-600 dark:text-green-400" on="saved">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ __('Perfil actualizado correctamente!') }}
                    </div>
                </x-action-message>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="photo"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#691b31] to-[#8a1f3f] border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-[#5a1629] hover:to-[#7a1b35] focus:outline-none focus:ring-2 focus:ring-[#691b31] focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition-all duration-200 shadow-lg hover:shadow-xl"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Actualizar Perfil') }}
                </button>
            </div>
        </form>
    </div>
</div>
