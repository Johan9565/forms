<?php

namespace App\Livewire;

use App\Models\FormApegoEtico;
use App\Models\Areas;
use App\Models\Dependencies;
use Livewire\Component;
use App\Helpers\StatisticsHelper;
use Illuminate\Support\Facades\Log;

class AllStatistics extends Component
{
    public $totalResponses;
    public $totalDependencies;
    public $totalAreas;
    public $formApegoEtico;
    public $countAnwersByArea;
    public $countforeachAnswerByArea;
    public $areasNames;
    public $charts;
    public $ask_names;

    public function mount()
    {
        $this->ask_names = [
            [
                "numero_pregunta" => 1,
                "pregunta" => "De las siguientes definiciones, tomando como referencia el Código de Ética y Reglas de Integridad. ¿Cuál de ellas corresponde a la Ética Pública?"
            ],
            [
                "numero_pregunta" => 2,
                "pregunta" => " ¿Qué importancia tiene implementar un Código de Ética y Reglas de Integridad dentro de la Administración Pública Municipal?"
            ],
            [
                "numero_pregunta" => 3,
                "pregunta" => "¿Qué Principios Constitucionales deben aplicar las personas servidoras públicas en su labor diaria?"
            ],
            [
                "numero_pregunta" => 5,
                "pregunta" => "¿Considera importante que existan normas que orienten el comportamiento ético de los servidores públicos?"
            ],
            [
                "numero_pregunta" => 8,
                "pregunta" => "¿Qué debe hacer un servidor público, si tiene conocimiento de un asunto en el que su objetividad e imparcialidad puedan verse afectadas por la existencia de algún conflicto de interés o impedimento legal?"
            ],
            [
                "numero_pregunta" => 9,
                "pregunta" => "¿Ha recibido alguna capacitación, charla o información sobre el Código de Ética y Reglas de Integridad?"
            ],
            [
                "numero_pregunta" => 10,
                "pregunta" => "¿Considera necesaria una capacitación de sensibilización en materia de ética?"
            ],
            [
                "numero_pregunta" => 12,
                "pregunta" => "Este valor ético consiste en que las personas servidoras públicas actúen buscando en todo momento la máxima atención de las necesidades y demandas de la sociedad por encima de intereses y beneficios particulares, ajenos a la satisfacción colectiva."
            ],
            [
                "numero_pregunta" => 13,
                "pregunta" => "¿Conoce los canales disponibles para señalar o presentar una queja o denuncia por probables infracciones al Código de Ética y Reglas de Integridad de los Servidores Públicos del Municipio de Benito Juárez?, en su caso, mencione 2 de ellos."
            ],
            [
                "numero_pregunta" => 14,
                "pregunta" => "¿Cuáles son las instancias a las que pueden acudir las personas servidoras públicas o particulares para hacer de conocimiento la vulneración o incumplimiento al Código de Ética y Reglas de integridad de los Servidores Públicos del Municipio de Benito Juárez, Quintana Roo?"
            ]
        ];
        $this->totalResponses = FormApegoEtico::count();
        $this->totalDependencies = Dependencies::count();
        $this->totalAreas = Areas::count();
        $this->formApegoEtico = FormApegoEtico::all();
        $this->countAnwersByArea = FormApegoEtico::select('form_apego_etico.*', 'area.name as area_name')
        ->join('area', 'form_apego_etico.area', '=', 'area.id_area')
        ->get()
        ->groupBy('area_name')
        ->toArray();
    $this->areasNames = array_keys($this->countAnwersByArea);



    $this->countforeachAnswerByArea = [];

    // Definir las preguntas y sus opciones
    $questions = [
        'pregunta1' => ['a', 'b', 'c'],
        'pregunta2' => ['muy_importante', 'algo_importante', 'nada_importante'],
        'pregunta3' => ['a', 'b', 'c'],
        'pregunta5' => ['si', 'no'],
        'pregunta8' => ['a', 'b', 'c'],
        'pregunta9' => ['si', 'no'],
        'pregunta10' => ['si', 'no'],
        'pregunta12' => ['etica_publica', 'interes_publico', 'liderazgo'],
        'pregunta13' => ['si', 'no'],
        'pregunta14' => ['a', 'b', 'c'],
    ];

    // Inicializar estructura por pregunta
    foreach ($questions as $question => $options) {
        $this->countforeachAnswerByArea[$question] = [];
        foreach ($options as $option) {
            $this->countforeachAnswerByArea[$question][$option] = [];
        }
    }
    // Contar respuestas por área para cada pregunta
    foreach ($this->countAnwersByArea as $areaId => $forms) {

        $formsCollection = collect($forms);

        foreach ($questions as $question => $options) {
            foreach ($options as $option) {
                $count = $formsCollection->where($question, $option)->count();
                $this->countforeachAnswerByArea[$question][$option][$areaId] = $count;
            }
        }
    }

    // Calculate percentages for individual questions based only on that question's responses
    $questionPercentages = StatisticsHelper::getQuestionPercentagesByAreaForCharts($this->countAnwersByArea, $questions, $this->areasNames);

    // Also organize counts in the same format for tooltips
    $questionCounts = [];
    foreach ($questions as $question => $options) {
        $questionCounts[$question] = [];
        foreach ($options as $option) {
            $questionCounts[$question][$option] = [];
            foreach ($this->areasNames as $areaName) {
                $forms = $this->countAnwersByArea[$areaName] ?? [];
                $formsCollection = collect($forms);
                $count = $formsCollection->where($question, $option)->count();
                $questionCounts[$question][$option][] = $count;
            }
        }
    }


    foreach ($this->countforeachAnswerByArea as $question => $options) {
        $this->charts[] = [
                'canvasId' => 'miChart'.$question,
                'labels' => $this->areasNames,
                'datasets' => $questionPercentages[$question], // Use percentages instead of counts
                'counts' => $questionCounts[$question], // Keep counts for tooltips
                'optionLabels' => array_keys($options)
        ];
    }

    // Get statistics with percentages for the main charts
    $chart3Stats = StatisticsHelper::getColumnCountsWithPercentages($this->formApegoEtico, ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'], true);
    $chart2Stats = StatisticsHelper::getColumnCountsWithPercentages($this->formApegoEtico, ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'], true);

    $this->charts[] =  [
        'canvasId' => 'miChart',
        'labels' => ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'],
        'datasets' => $chart3Stats['percentages'],
        'counts' => $chart3Stats['counts'],
        'optionLabels' => ['a', 'b', 'c']
];
$this->charts[] =  [
        'canvasId' => 'miChart2',
        'labels' => ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'],
        'datasets' => $chart2Stats['percentages'],
        'counts' => $chart2Stats['counts'],
        'optionLabels' => ['si', 'no']
];

    }

    public function hydrate()
    {
        // Don't initialize charts here, wait for render
    }

    public function dehydrate()
    {
        // Clean up charts when component is being destroyed
        $this->dispatch('cleanupCharts');
    }

    public function render()
    {
        // Initialize charts after render
        $this->dispatch('initializeStatisticsCharts', [
            'chartData' => $this->charts,
            'config' => [
                'scales' => [
                    'x' => [
                        'ticks' => [
                            'callback' => "function(value, index, ticks) {
                                let label = this.getLabelForValue(value);
                                return label.length > 10 ? label.substr(0, 10) + '…' : label;
                            }"
                        ]
                    ],
                    'y' => [
                        'ticks' => [
                            'callback' => "function(value, index, ticks) {
                                return value + '%';
                            }",
                            'max' => 100
                        ]
                    ]
                ],
                'plugins' => [
                    'tooltip' => [
                        'callbacks' => [
                            'label' => "function(context) {
                                const label = context.dataset.label || '';
                                const value = context.parsed.y;
                                const counts = context.chart.data.counts;
                                const dataIndex = context.dataIndex;
                                const datasetIndex = context.datasetIndex;

                                // Handle both individual question charts and general charts
                                let count = 0;
                                if (counts) {
                                    if (counts[label] && Array.isArray(counts[label])) {
                                        // Individual question chart - counts[label] is an array of counts per area
                                        count = counts[label][dataIndex] || 0;
                                    } else if (counts['index' + datasetIndex]) {
                                        // General chart - counts['index' + datasetIndex] is an array of counts per question
                                        count = counts['index' + datasetIndex][dataIndex] || 0;
                                    }
                                }

                                return label + ': ' + value + '% (' + count + ' respuestas)';
                            }"
                        ]
                    ]
                ]
            ]
        ]);


        return view('livewire.all-statistics');
    }


}