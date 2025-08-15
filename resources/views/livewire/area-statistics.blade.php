<div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Estadísticas de la área</h3>
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
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Gráficos de las preguntas</h3>
    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Question 1 Chart -->

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Total preguntas de 3 opciones</h3>
            <canvas id="miChart" width="400" height="200"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Total preguntas de 2 opciones</h3>
            <canvas id="miChart2" width="400" height="200"></canvas>
        </div>
    </div>
</div>
