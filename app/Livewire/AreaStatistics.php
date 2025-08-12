<?php

namespace App\Livewire;

use App\Models\FormApegoEtico;
use App\Models\Areas;
use App\Models\Dependencies;
use Livewire\Component;
use App\Helpers\StatisticsHelper;

class AreaStatistics extends Component
{
    public $area;
    public $totalResponses;
    public $totalDependencies;
    public $totalAreas;
    public $formApegoEtico;

    public function mount($area = null)
    {
        $this->area = $area;
        $this->loadStatistics();
    }

    public function updatedArea($value)
    {
        $this->loadStatistics();
    }

    private function loadStatistics()
    {
        if ($this->area) {
            $this->formApegoEtico = FormApegoEtico::where('area', $this->area)->get();
            $this->totalResponses = $this->formApegoEtico->count();
        } else {
            $this->formApegoEtico = collect();
            $this->totalResponses = 0;
        }

        $this->totalDependencies = Dependencies::count();
        $this->totalAreas = Areas::count();
    }

    public function render()
    {
        // Get statistics with percentages
        $chart3Stats = StatisticsHelper::getColumnCountsWithPercentages($this->formApegoEtico, ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'], true);
        $chart2Stats = StatisticsHelper::getColumnCountsWithPercentages($this->formApegoEtico, ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'], true);

        $this->dispatch('initializeStatisticsCharts', [
            'chartData' => [
                'chart3fields' => [
                    'canvasId' => 'miChart',
                    'labels' => ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'],
                    'datasets' => $chart3Stats['percentages'],
                    'counts' => $chart3Stats['counts'],
                    'optionLabels' => ['a', 'b', 'c']
                ],
                'chart2fields' => [
                    'canvasId' => 'miChart2',
                    'labels' => ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'],
                    'datasets' => $chart2Stats['percentages'],
                    'counts' => $chart2Stats['counts'],
                    'optionLabels' => ['si', 'no']
                ]
            ],
            'config' => [
                'scales' => [
                    'y' => [
                        'ticks' => [
                            'callback' => "function(value, index, ticks) {
                                return value + '%';
                            }"
                        ],
                        'max' => 100
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
                                const countKey = 'index' + datasetIndex;
                                const count = counts && counts[countKey] ? counts[countKey][dataIndex] : 0;
                                return label + ': ' + value + '% (' + count + ' respuestas)';
                            }"
                        ]
                    ]
                ]
            ]
        ]);

        return view('livewire.area-statistics');
    }
}
