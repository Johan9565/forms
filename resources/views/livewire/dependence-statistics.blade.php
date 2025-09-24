<div>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Estadísticas de la dependencia</h3>
        <button 
            wire:click="exportToExcel"
            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-md hover:shadow-lg"
            title="Exportar estadísticas por área a CSV"
        >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Exportar a CSV
        </button>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Respuestas</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalResponses }}</p>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="mb-8">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                                <button
                    wire:click="$set('tab', 'areasbyquestions')"
                    class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium focus:z-10 focus:outline-none transition-all duration-200 {{ $tab === 'areasbyquestions' ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}"
                >
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>Total por Área</span>
                    </div>
                                                                                                    <span
                        class="absolute inset-x-0 bottom-0 h-0.5 transition-all duration-200 {{ $tab === 'areasbyquestions' ? 'bg-blue-600 dark:bg-blue-400' : 'bg-transparent group-hover:bg-gray-300 dark:group-hover:bg-gray-600' }}"
                    ></span>
                </button>

                                                                <button
                    wire:click="$set('tab', 'questionsbyarea')"
                    class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium focus:z-10 focus:outline-none transition-all duration-200 {{ $tab === 'questionsbyarea' ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}"
                >
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Preguntas Individuales</span>
                    </div>
                                                                                                    <span
                        class="absolute inset-x-0 bottom-0 h-0.5 transition-all duration-200 {{ $tab === 'questionsbyarea' ? 'bg-blue-600 dark:bg-blue-400' : 'bg-transparent group-hover:bg-gray-300 dark:group-hover:bg-gray-600' }}"
                    ></span>
                </button>
            </nav>
        </div>
    </div>

    <!-- Tab Content -->
    @if($tab === 'areasbyquestions')
        <!-- Areas by Questions Tab -->
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Total de la dependencia</h3>
            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Question 1 Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Total preguntas de 3 opciones</h3>
                    <canvas id="miChartgeneral" width="400" height="200"></canvas>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Total preguntas de 2 opciones</h3>
                    <canvas id="miChart2general" width="400" height="200"></canvas>
                </div>
            </div>
            @if (!empty($charts))
    @foreach ($charts as $chart)
    @php
        // Mostrar solo los charts que NO son por área (canvasId que NO contienen un número de área al final)
        $isNotAreaChart = !preg_match('/miChart\d+$/', $chart['canvasId']);
        $isNotGeneralChart = $chart['canvasId'] != 'miChartgeneral' && $chart['canvasId'] != 'miChart2general';
    @endphp
    @if($isNotAreaChart && $isNotGeneralChart)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-4">
            @php
                // Extraer el número de pregunta del canvasId, por ejemplo: "miChartpregunta1" => "Pregunta 1"
                $preguntaLabel = '';
                if (preg_match('/miChartpregunta(\d+)/', $chart['canvasId'], $matches)) {
                    $numeroPregunta = $matches[1];
                    $preguntaEncontrada = collect($ask_names)->firstWhere('numero_pregunta', $numeroPregunta);
                    if ($preguntaEncontrada) {
                        $preguntaLabel = 'Pregunta ' . $numeroPregunta . ': ' . $preguntaEncontrada['pregunta'];
                    } else {
                        $preguntaLabel = 'Pregunta ' . $numeroPregunta;
                    }
                } else {
                    $preguntaLabel = $chart['canvasId'];
                }
            @endphp
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ $preguntaLabel }}</h3>
            <canvas id="{{ $chart['canvasId'] }}" width="400" height="200"></canvas>
        </div>
    @endif
    @endforeach
    @endif
        </div>
    @endif

    @if($tab === 'questionsbyarea')
        <!-- Questions by Area Tab -->
        <div>
            @foreach ($areas as $area)
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Total de la {{ $area->name }} - {{ $areaTotals[$area->id_area] }}</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <canvas id="miChart{{ $area->id_area }}" width="400" height="200"></canvas>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <canvas id="miChart2{{ $area->id_area }}" width="400" height="200"></canvas>
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>
