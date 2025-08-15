<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FormApegoEtico;
use App\Models\Areas;
use App\Models\Dependencies;


class ApegoEticoStatistics extends Component
{
    public $formApegoEtico;
    public $areas_select;
    public $area;
    public $dependency;
    public $dependencies_select;
    public $filter = 'all';
    public $areaDisabled = false;
    public $dependencyDisabled = false;

    public function mount(){
        $this->formApegoEtico = FormApegoEtico::all();
        $this->areas_select = $this->getAreasOptions();
        $this->dependencies_select = $this->getDependenciesOptions();
        $this->filter = 'all';
    }

    public function render()
    {

        return view('livewire.apego-etico-statistics', [

        ]);
    }

    private function getAreasOptions(): array
    {
        $areas = Areas::all();
        return ['options' => $areas->map(function ($area) {
            // Use 'role' field for display (user-friendly) and 'name' for value (system-friendly

            $displayName = $area->name ?? 'Unknown Area';
            $systemName = $area->id_area  ?? 'unknown';

            return [
                'value' => $systemName,
                'text' => $displayName
            ];
        })->toArray(), 'count' => $areas->count()];
    }

    private function getDependenciesOptions(): array
    {
        $dependencies = Dependencies::all();
        return ['options' => $dependencies->map(function ($dependency) {
            return [
                'value' => $dependency->id_dependence,
                'text' => $dependency->dependence_name
            ];
        })->toArray(), 'count' => $dependencies->count()];
    }

    public function updatedArea($value)
    {
        if ($value && $value !== "" && $value !== null) {
            $this->dependencyDisabled = true;
            $this->filter = 'area';
            $this->dependency = null; // Clear dependency when area is selected
            $this->dispatch('area-selected', $this->dependencyDisabled);
        } else {
            $this->filter = 'all';
            $this->area = null;
            $this->dependencyDisabled = false;
            $this->dispatch('area-selected', $this->dependencyDisabled);
        }
    }

    public function updatedDependency($value)
    {
        if ($value && $value !== "" && $value !== null) {
            $this->areaDisabled = true;
            $this->filter = 'dependence';
            $this->dispatch('dependency-selected', $this->areaDisabled);
        } else {
            $this->filter = 'all';
            $this->dependency = null;
            $this->areaDisabled = false;
            $this->dispatch('dependency-selected', $this->areaDisabled);


        }
    }



    public function refresh()
    {
        // This method will be called when the component needs to refresh
        $this->dispatch('$refresh');
    }

    public function updatedFilter()
    {
        // Ensure proper state when filter changes
        if ($this->filter === 'all') {
            $this->area = null;
            $this->dependency = null;
        }
    }
}
