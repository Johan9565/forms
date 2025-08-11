<?php

namespace App\Livewire;

use App\Models\FormApegoEtico;
use App\Models\Areas;
use App\Models\Dependencies;
use Livewire\Component;
use App\Helpers\StatisticsHelper;

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

    public function mount()
    {
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

    foreach ($this->countforeachAnswerByArea as $question => $options) {
        $this->charts[] = [
                'canvasId' => 'miChart'.$question,
                'labels' => $this->areasNames,
                'datasets' => $options,
                'optionLabels' => array_keys($options)

        ];
    }

    $this->charts[] =  [
        'canvasId' => 'miChart',
        'labels' => ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'],
        'datasets' => StatisticsHelper::getColumnCounts($this->formApegoEtico, ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'], true),
        'optionLabels' => ['a', 'b', 'c']
];
$this->charts[] =  [
        'canvasId' => 'miChart2',
        'labels' => ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'],
        'datasets' => StatisticsHelper::getColumnCounts($this->formApegoEtico, ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'], true),
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
                    ]
                ]
            ]
        ]);


        return view('livewire.all-statistics');
    }


}