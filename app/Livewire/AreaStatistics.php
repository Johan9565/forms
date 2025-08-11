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
        $this->dispatch('initializeStatisticsCharts', [
            'chartData' => [
                'chart3fields' => [
                    'canvasId' => 'miChart',
                    'labels' => ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'],
                    'datasets' => StatisticsHelper::getColumnCounts($this->formApegoEtico, ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'], true),
                    'optionLabels' => ['a', 'b', 'c']
                ],
                'chart2fields' => [
                    'canvasId' => 'miChart2',
                    'labels' => ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'],
                    'datasets' => StatisticsHelper::getColumnCounts($this->formApegoEtico, ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'], true),
                    'optionLabels' => ['si', 'no']
                ]
            ]
        ]);

        return view('livewire.area-statistics');
    }
}