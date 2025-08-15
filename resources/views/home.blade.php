<x-front-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                Formularios Disponibles
                            </h2>
                            <p class="text-gray-600 dark:text-gray-400">
                                Seleccione el formulario que desea contestar
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-gray-50 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8">
                    <!-- Encuesta de Apego Ético -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Encuesta de Apego Ético
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Código de Ética y Reglas de Integridad
                                    </p>
                                </div>
                            </div>

                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                                Cuestionario dirigido a todas las personas servidoras públicas de la Administración
                                Pública Municipal para conocer la percepción sobre los principios y valores del Código
                                de Ética.
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>17 preguntas</span>
                                </div>

                                <a href="{{ route('forms.view') }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    ir al formulario
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>


