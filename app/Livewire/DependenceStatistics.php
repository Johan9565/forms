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
                'chart3fields' => StatisticsHelper::getColumnCounts($formsCollection, ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'], true),
                'chart2fields' => StatisticsHelper::getColumnCounts($formsCollection, ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'], true)
            ];
        }
        foreach ($statisticsByArea as $areaId => $statistics) {

          $this->charts[] =  [
                'canvasId' => 'miChart'.$areaId,
                'labels' => ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'],
                'datasets' => $statistics['chart3fields'],
                'optionLabels' => ['a', 'b', 'c']
            ];
            $this->charts[] = [
                'canvasId' => 'miChart2'.$areaId,
                'labels' => ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'],
                'datasets' => $statistics['chart2fields'],
                'optionLabels' => ['si', 'no']
            ];
        }
        $this->charts[] =  [
                    'canvasId' => 'miChartgeneral',
                    'labels' => ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'],
                    'datasets' => StatisticsHelper::getColumnCounts($flattenedForms, ['pregunta1', 'pregunta2', 'pregunta3', 'pregunta8', 'pregunta12', 'pregunta14'], true),
                    'optionLabels' => ['a', 'b', 'c']
        ];
        $this->charts[] =  [
                    'canvasId' => 'miChart2general',
                    'labels' => ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'],
                    'datasets' => StatisticsHelper::getColumnCounts($flattenedForms, ['pregunta5', 'pregunta9', 'pregunta10', 'pregunta13'], true),
                    'optionLabels' => ['si', 'no']
        ];
        // Also flatten the grouped data for overall statistics
        $flattenedForms = collect($this->formApegoEtico)->flatten(1);

        $this->dispatch('initializeStatisticsCharts', [
            'chartData' => $this->charts
        ]);

        return view('livewire.dependence-statistics');
    }
}
