<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                Estadísticas - Encuesta de Apego Ético
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Análisis de respuestas del Código de Ética y Reglas de Integridad
            </p>
        </div>

        {{-- Filtro de respuestas --}}
        <div class="mb-6 flex flex-col md:flex-row gap-4">
            <div>
                <label for="areaFilter"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Área</label>
                <x-select-component id="area" name="area" model="area" placeholder="Seleccione un área"
                    :options="$areas_select['options']" :selected="$areas_select['options']" class="w-full" wire:ignore />
                @error('area')
                    <div class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </div>
                @enderror

            </div>

            <div>
                <label for="dependencyFilter"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dependencia</label>
                <x-select-component id="dependency" name="dependency" model="dependency"
                    placeholder="Seleccione una dependencia" :options="$dependencies_select['options']" :selected="$dependencies_select['options']" class="w-full"
                    wire:ignore />
                @error('dependency')
                    <div class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </div>
                @enderror
            </div>

        </div>
        <div wire:key="statistics-container-{{ $filter }}-{{ $area }}-{{ $dependency }}">
            @switch($filter)
                @case('all')
                    <!-- Summary Cards -->
                    <livewire:all-statistics :key="'all-statistics-'.$filter" />
                    @break
                @case('area')
                <livewire:area-statistics :area="$area" :key="'area-statistics-'.$area" />
                    @break
                @case('dependence')
                    <livewire:dependence-statistics :dependency="$dependency" :key="'dependence-statistics-'.$dependency" />
                    @break
                @default
                    <!-- Summary Cards -->
                    <livewire:all-statistics :key="'all-statistics-'.$filter" />
                    @break
            @endswitch
        </div>

        </div>




    </div>
</div>
