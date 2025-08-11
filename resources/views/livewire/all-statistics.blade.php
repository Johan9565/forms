<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
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

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Dependencias</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalDependencies }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Áreas</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalAreas }}</p>
                </div>
            </div>
        </div>

    </div>

    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Gráficos de las preguntas</h3>
    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">


        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Total preguntas de 3 opciones</h3>
            <canvas id="miChart" width="400" height="200"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Total preguntas de 2 opciones</h3>
            <canvas id="miChart2" width="400" height="200"></canvas>
        </div>
    </div>
    @if (!empty($charts))
    @foreach ($charts as $chart)
    @if($chart['canvasId'] != 'miChart' && $chart['canvasId'] != 'miChart2')
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-4">
            @php
                // Extraer el número de pregunta del canvasId, por ejemplo: "miChartpregunta1" => "1"
                $preguntaLabel = '';
                if (preg_match('/miChartpregunta(\d+)/', $chart['canvasId'], $matches)) {
                    $preguntaLabel = 'Pregunta ' . $matches[1];
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
