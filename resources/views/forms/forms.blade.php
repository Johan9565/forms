<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">


        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                ENCUESTA DE APEGO ÉTICO
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                El presente cuestionario está dirigido a todas las personas servidoras públicas de la Administración
                Pública Municipal.
            </p>
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                El objetivo de este cuestionario es determinar el nivel de conocimiento y aplicación que tienen las personas servidoras públicas respecto de los principios y valores que contiene el Código de Ética y Reglas de Integridad de los Servidores Públicos del Municipio de Benito Juárez.
            </p>
        </div>

        <form wire:submit="submitForm" class="space-y-8">
            <!-- Select de Dependencias -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Seleccione su área
                </h3>
                <x-select-component id="area_seleccionada" name="area_seleccionada" model="area_seleccionada"
                    placeholder="Seleccione un área" :options="$areas" :selected="$area_seleccionada" class="w-full" wire:ignore />
                @error('area_seleccionada')
                    <div class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Pregunta 1 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    1. De las siguientes definiciones, tomando como referencia el Código de Ética y Reglas de Integridad. ¿Cuál de ellas corresponde a la Ética Pública?
                </h3>
                <div class="space-y-3">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta1" value="a" class="text-blue-600"
                            wire:model="pregunta1">
                        <span class="text-gray-700 dark:text-gray-300">
                            a) Conjunto de cualidades por las que una persona servidora pública es apreciada o bien
                            considerada en el servicio público.
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta1" value="b" class="text-blue-600"
                            wire:model="pregunta1">
                        <span class="text-gray-700 dark:text-gray-300">
                            b) Disciplina basada en normas de conducta que se fundamentan en el deber público y que
                            busca en toda decisión y acción, la prevalencia del bienestar de la sociedad en coordinación
                            con los objetivos del Estado mexicano, de los entes públicos y de la responsabilidad de la
                            persona ante éstos;
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta1" value="c" class="text-blue-600"
                            wire:model="pregunta1">
                        <span class="text-gray-700 dark:text-gray-300">
                            c) Normatividad que obliga a los servidores públicos a actuar de forma respetuosa, orientada a la legalidad, honradez y lealtad.
                        </span>
                    </label>
                </div>
                @error('pregunta1')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 2 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    2. ¿Qué importancia tiene implementar un Código de Ética y Reglas de Integridad dentro de la
                    Administración Pública Municipal?
                </h3>
                <div class="grid grid-cols-3 gap-4">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta2" value="muy_importante" class="text-blue-600"
                            wire:model="pregunta2">
                        <span class="text-gray-700 dark:text-gray-300">Muy Importante</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta2" value="algo_importante" class="text-blue-600"
                            wire:model="pregunta2">
                        <span class="text-gray-700 dark:text-gray-300">Algo importante</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta2" value="nada_importante" class="text-blue-600"
                            wire:model="pregunta2">
                        <span class="text-gray-700 dark:text-gray-300">Nada importante</span>
                    </label>
                </div>
                @error('pregunta2')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 3 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    3. ¿Qué Principios Constitucionales deben aplicar las personas servidoras públicas en su labor
                    diaria?
                </h3>
                <div class="space-y-3">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta3" value="a" class="text-blue-600"
                            wire:model="pregunta3">
                        <span class="text-gray-700 dark:text-gray-300">
                            a) Cumplir con las declaraciones patrimoniales, de intereses y fiscales.
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta3" value="b" class="text-blue-600"
                            wire:model="pregunta3">
                        <span class="text-gray-700 dark:text-gray-300">
                            b) Lealtad e imparcialidad.
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta3" value="c" class="text-blue-600"
                            wire:model="pregunta3">
                        <span class="text-gray-700 dark:text-gray-300">
                            c) Acatar las instrucciones formuladas por escrito por el jefe inmediato.
                        </span>
                    </label>
                </div>
                @error('pregunta3')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 4 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    4. A partir de la siguiente definición referente al Código de Ética y las Reglas de Integridad de
                    los Servidores Públicos del Municipio de Benito Juárez; haga una descripción breve de dicho
                    concepto.
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4 italic">
                    "El Código de Ética establecerá mecanismos de capacitación de las personas servidoras públicas en el
                    razonamiento sobre los principios y valores que deberán de prevalecer en la toma de decisiones y en
                    el correcto ejercicio de la función pública y por el desempeño del cargo y facultades asignadas."
                </p>
                <textarea wire:model="pregunta4" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Su respuesta..."></textarea>
                @error('pregunta4')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 5 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    5. ¿Considera importante que existan normas que orienten el comportamiento ético de los servidores
                    públicos?
                </h3>
                <div class="flex space-x-6">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta5" value="si" class="text-blue-600"
                            wire:model="pregunta5">
                        <span class="text-gray-700 dark:text-gray-300">Sí</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta5" value="no" class="text-blue-600"
                            wire:model="pregunta5">
                        <span class="text-gray-700 dark:text-gray-300">No</span>
                    </label>
                </div>
                @error('pregunta5')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 6 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    6. Describa brevemente una situación específica que haya ocurrido en su área de trabajo y que
                    considere que no se observaron uno de los siguientes principios: honradez, honestidad y disciplina:
                </h3>
                <textarea wire:model="pregunta6" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Su respuesta..."></textarea>
                @error('pregunta6')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 7 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    7. ¿Qué acciones cree usted que pueden fortalecer la ética pública y la integridad en su área de
                    trabajo?
                </h3>
                <textarea wire:model="pregunta7" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Su respuesta..."></textarea>
                @error('pregunta7')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 8 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    8. ¿Qué debe hacer un servidor público, si tiene conocimiento de un asunto en el que su objetividad
                    e imparcialidad puedan verse afectadas por la existencia de algún conflicto de interés o impedimento
                    legal?
                </h3>
                <div class="space-y-3">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta8" value="a" class="text-blue-600"
                            wire:model="pregunta8">
                        <span class="text-gray-700 dark:text-gray-300">
                            a) Solicitar ser excusado de participar en cualquier forma, en la atención, tramitación o
                            resolución del asunto.
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta8" value="b" class="text-blue-600"
                            wire:model="pregunta8">
                        <span class="text-gray-700 dark:text-gray-300">
                            b) Continuar con el asunto hasta su conclusión.
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta8" value="c" class="text-blue-600"
                            wire:model="pregunta8">
                        <span class="text-gray-700 dark:text-gray-300">
                            c) Informar por escrito a la Contraloría Municipal la existencia del conflicto de intereses
                            o impedimento legal.
                        </span>
                    </label>
                </div>
                @error('pregunta8')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 9 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    9. ¿Ha recibido alguna capacitación, charla o información sobre el Código de Ética y Reglas de
                    Integridad?
                </h3>
                <div class="flex space-x-6">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta9" value="si" class="text-blue-600"
                            wire:model="pregunta9">
                        <span class="text-gray-700 dark:text-gray-300">Sí</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta9" value="no" class="text-blue-600"
                            wire:model="pregunta9">
                        <span class="text-gray-700 dark:text-gray-300">No</span>
                    </label>
                </div>
                @error('pregunta9')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 10 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    10. ¿Considera necesaria una capacitación de sensibilización en materia de ética?
                </h3>
                <div class="flex space-x-6">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta10" value="si" class="text-blue-600"
                            wire:model="pregunta10">
                        <span class="text-gray-700 dark:text-gray-300">Sí</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta10" value="no" class="text-blue-600"
                            wire:model="pregunta10">
                        <span class="text-gray-700 dark:text-gray-300">No</span>
                    </label>
                </div>
                @error('pregunta10')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 11 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    11. Elija 3 Principios Constitucionales que sea necesario reforzar en su área de trabajo y
                    explique brevemente los motivos
                </h3>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="honestidad" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Honestidad</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="economia" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Economía</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="lealtad" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Lealtad</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="integridad" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Integridad</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="eficacia" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Eficacia</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="rendicion_cuentas" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Rendición de Cuentas</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="objetividad" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Objetividad</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="profesionalismo" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Profesionalismo</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="legalidad" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Legalidad</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="equidad" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Equidad</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="eficiencia" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Eficiencia</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="honradez" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Honradez</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="competencia_merito" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Competencia por Mérito</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="disciplina" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Disciplina</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="imparcialidad" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Imparcialidad</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="principios[]" value="transparencia" class="text-blue-600"
                            wire:model="principios" wire:change="checkPrincipiosLimit">
                        <span class="text-gray-700 dark:text-gray-300">Transparencia</span>
                    </label>
                </div>
                <textarea wire:model="pregunta11_explicacion" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Explicación de los motivos..."></textarea>
                @error('pregunta11_explicacion')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 12 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    12. Este valor ético consiste en que las personas servidoras públicas actúen buscando en todo
                    momento la máxima atención de las necesidades y demandas de la sociedad por encima de intereses y
                    beneficios particulares, ajenos a la satisfacción colectiva.
                </h3>
                <div class="space-y-3">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta12" value="etica_publica" class="text-blue-600"
                            wire:model="pregunta12">
                        <span class="text-gray-700 dark:text-gray-300">Ética Pública</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta12" value="interes_publico" class="text-blue-600"
                            wire:model="pregunta12">
                        <span class="text-gray-700 dark:text-gray-300">Interés Público</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta12" value="liderazgo" class="text-blue-600"
                            wire:model="pregunta12">
                        <span class="text-gray-700 dark:text-gray-300">Liderazgo</span>
                    </label>
                </div>
                @error('pregunta12')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 13 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    13. ¿Conoce los canales disponibles para señalar o presentar una queja o denuncia por probables infracciones al Código de Ética y Reglas de Integridad de los Servidores Públicos del Municipio de Benito Juárez?, en su caso, mencione 2 de ellos.
                </h3>
                <div class="flex space-x-6 mb-4">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta13" value="si" class="text-blue-600"
                            wire:model="pregunta13">
                        <span class="text-gray-700 dark:text-gray-300">Sí</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta13" value="no" class="text-blue-600"
                            wire:model="pregunta13">
                        <span class="text-gray-700 dark:text-gray-300">No</span>
                    </label>
                </div>
                <textarea wire:model="pregunta13_explicacion" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Mencione 2 canales..."></textarea>
                @error('pregunta13')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                @error('pregunta13_explicacion')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 14 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    14. ¿Cuáles son las instancias a las que pueden acudir las personas servidoras públicas o particulares para hacer de conocimiento la vulneración o incumplimiento al Código de Ética y Reglas de integridad de los Servidores Públicos del Municipio de Benito Juárez, Quintana Roo?
                </h3>
                <div class="space-y-3">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta14" value="a" class="text-blue-600"
                            wire:model="pregunta14">
                        <span class="text-gray-700 dark:text-gray-300">
                            a) En primera instancia la Contraloría Municipal y en segunda instancia la Fiscalía Especializada en Combate a la Corrupción
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta14" value="b" class="text-blue-600"
                            wire:model="pregunta14">
                        <span class="text-gray-700 dark:text-gray-300">
                            b) En primera instancia el Comité de Ética y Prevención de Conflictos de Interés y en segunda instancia Contraloría Municipal
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="pregunta14" value="c" class="text-blue-600"
                            wire:model="pregunta14">
                        <span class="text-gray-700 dark:text-gray-300">
                            c) En primera instancia la Fiscalía Especializada en Combate a la Corrupción y en segunda instancia Comité de Ética y de Prevención de Conflictos de Interés
                        </span>
                    </label>
                </div>
                @error('pregunta14')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 15 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    15. ¿Conoce a los compañeros que integran el Comité de Ética y Prevención de Conflictos de Interés de la dependencia a la que se encuentra adscrito, y cuáles son sus funciones?
                </h3>
                <textarea wire:model="pregunta15" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Su respuesta..."></textarea>
                @error('pregunta15')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pregunta 16 -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    16. ¿Considera que su superior jerárquico es ejemplo como servidor público que cumple y respeta los
                    Principios Constitucionales y Valores Éticos del servicio público?
                </h3>
                <textarea wire:model="pregunta16" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Argumente su respuesta..."></textarea>
                @error('pregunta16')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-center space-x-4 pt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Enviar Encuesta
                </button>


            </div>
        </form>
    </div>
</div>
