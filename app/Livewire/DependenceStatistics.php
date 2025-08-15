<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FormApegoEtico;
use App\Models\Dependencies;
use App\Models\Areas;
use App\Helpers\StatisticsHelper;

class DependenceStatistics extends Component
{
    public $dependency;
    public $areas;
    public $totalResponses;
    public $totalAreas;
    public $formApegoEtico;
    public $charts = [];
    public $areaTotals = [];
    public $tab = 'areasbyquestions';
    public $countAnwersByArea;
    public $areasNames;
    public $countforeachAnswerByArea;

    public function mount($dependency = null)
    {
        $this->dependency = $dependency;
        $this->loadStatistics();

    }

    private function loadStatistics()
    {
        if ($this->dependency) {
            $areas = Areas::where('id_dependence', $this->dependency)->get();
            $this->areas = $areas;
            $formsByArea = FormApegoEtico::whereIn('area', $areas->pluck('id_area'))
                ->get()
                ->groupBy('area')
                ->toArray();

            $this->formApegoEtico = $formsByArea;
            $this->totalResponses = collect($formsByArea)->flatten(1)->count();

            // Calculate total responses for each area
            $this->areaTotals = [];
            foreach ($areas as $area) {
                $this->areaTotals[$area->id_area] = isset($formsByArea[$area->id_area]) ? count($formsByArea[$area->id_area]) : 0;
            }

            $this->countAnwersByArea = FormApegoEtico::select('form_apego_etico.*', 'area.name as area_name')
                ->join('area', 'form_apego_etico.area', '=', 'area.id_area')
                ->whereIn('form_apego_etico.area', $areas->pluck('id_area')->toArray())
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
        } else {
            $this->formApegoEtico = [];
            $this->totalResponses = 0;
            $this->areaTotals = [];
        }

        $this->totalAreas = Areas::count();
    }

    public function render()
    {
        // Process statistics for each area separately
        $statisticsByArea = [];
        $flattenedForms = collect($this->formApegoEtico)->flatten(1);

        foreach ($this->formApegoEtico as $areaId => $forms) {
            // Convert array to collection for StatisticsHelper
            $formsCollection = collect($forms);

            $statisticsByArea[$areaId] = [
                'chart3fields' => StatisticsHelper::getColumnCountsWithPercentages($formsCollection, ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'], true),
                'chart2fields' => StatisticsHelper::getColumnCountsWithPercentages($formsCollection, ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'], true)
            ];
        }
        foreach ($statisticsByArea as $areaId => $statistics) {

          $this->charts[] =  [
                'canvasId' => 'miChart'.$areaId,
                'labels' => ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'],
                'datasets' => $statistics['chart3fields']['percentages'],
                'counts' => $statistics['chart3fields']['counts'],
                'optionLabels' => ['a', 'b', 'c']
            ];
            $this->charts[] = [
                'canvasId' => 'miChart2'.$areaId,
                'labels' => ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'],
                'datasets' => $statistics['chart2fields']['percentages'],
                'counts' => $statistics['chart2fields']['counts'],
                'optionLabels' => ['si', 'no']
            ];
        }

        // Get statistics for general charts
        $generalChart3Stats = StatisticsHelper::getColumnCountsWithPercentages($flattenedForms, ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'], true);
        $generalChart2Stats = StatisticsHelper::getColumnCountsWithPercentages($flattenedForms, ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'], true);

        $this->charts[] =  [
                    'canvasId' => 'miChartgeneral',
                    'labels' => ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'],
                    'datasets' => $generalChart3Stats['percentages'],
                    'counts' => $generalChart3Stats['counts'],
                    'optionLabels' => ['a', 'b', 'c']
        ];
        $this->charts[] =  [
                    'canvasId' => 'miChart2general',
                    'labels' => ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'],
                    'datasets' => $generalChart2Stats['percentages'],
                    'counts' => $generalChart2Stats['counts'],
                    'optionLabels' => ['si', 'no']
        ];
        // Also flatten the grouped data for overall statistics
        $flattenedForms = collect($this->formApegoEtico)->flatten(1);

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

        return view('livewire.dependence-statistics');
    }
}