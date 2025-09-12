<?php

namespace App\Livewire;

use App\Models\Dependencies;
use App\Models\Areas;
use App\Models\FormApegoEtico;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Forms extends Component
{
    use WithPagination;

    // Properties for form data
    public $pregunta1 = '';
    public $pregunta2 = '';
    public $pregunta3 = '';
    public $pregunta4 = '';
    public $pregunta5 = '';
    public $pregunta6 = '';
    public $pregunta7 = '';
    public $pregunta8 = '';
    public $pregunta9 = '';
    public $pregunta10 = '';
    public $principios = [];
    public $pregunta11_explicacion = '';
    public $pregunta12 = '';
    public $pregunta13 = '';
    public $pregunta13_explicacion = '';
    public $pregunta14 = '';
    public $pregunta15 = '';
    public $pregunta16 = '';
    public $area_seleccionada = null;
    public $areas = [];
    // Validation rules
    protected $rules = [
        'area_seleccionada' => 'required',
        'pregunta1' => 'required',
        'pregunta2' => 'required',
        'pregunta3' => 'required',
        'pregunta4' => 'required|min:10',
        'pregunta5' => 'required',
        'pregunta6' => 'required|min:10',
        'pregunta7' => 'required|min:10',
        'pregunta8' => 'required',
        'pregunta9' => 'required',
        'pregunta10' => 'required',
        'principios' => 'required|array|min:1|max:3',
        'pregunta11_explicacion' => 'required|min:10',
        'pregunta12' => 'required',
        'pregunta13' => 'required',
        'pregunta13_explicacion' => 'required_if:pregunta13,si|min:10',
        'pregunta14' => 'required',
        'pregunta15' => 'required|min:10',
        'pregunta16' => 'required|min:10',
    ];

    // Custom validation messages
    protected $messages = [
        'area_seleccionada.required' => 'Debe seleccionar un área.',
        'pregunta1.required' => 'Debe seleccionar una opción para la pregunta 1.',
        'pregunta2.required' => 'Debe seleccionar una opción para la pregunta 2.',
        'pregunta3.required' => 'Debe seleccionar una opción para la pregunta 3.',
        'pregunta4.required' => 'Debe responder la pregunta 4.',
        'pregunta4.min' => 'La respuesta de la pregunta 4 debe tener al menos 10 caracteres.',
        'pregunta5.required' => 'Debe seleccionar una opción para la pregunta 5.',
        'pregunta6.required' => 'Debe responder la pregunta 6.',
        'pregunta6.min' => 'La respuesta de la pregunta 6 debe tener al menos 10 caracteres.',
        'pregunta7.required' => 'Debe responder la pregunta 7.',
        'pregunta7.min' => 'La respuesta de la pregunta 7 debe tener al menos 10 caracteres.',
        'pregunta8.required' => 'Debe seleccionar una opción para la pregunta 8.',
        'pregunta9.required' => 'Debe seleccionar una opción para la pregunta 9.',
        'pregunta10.required' => 'Debe seleccionar una opción para la pregunta 10.',
        'principios.required' => 'Debe seleccionar al menos un principio constitucional.',
        'principios.min' => 'Debe seleccionar al menos un principio constitucional.',
        'principios.max' => 'Debe seleccionar máximo 3 principios constitucionales.',
        'pregunta11_explicacion.required' => 'Debe explicar los motivos de su selección.',
        'pregunta11_explicacion.min' => 'La explicación debe tener al menos 10 caracteres.',
        'pregunta12.required' => 'Debe seleccionar una opción para la pregunta 12.',
        'pregunta13.required' => 'Debe seleccionar una opción para la pregunta 13.',
        'pregunta13_explicacion.required_if' => 'Si selecciona Sí, debe mencionar los canales.',
        'pregunta13_explicacion.min' => 'La explicación debe tener al menos 10 caracteres.',
        'pregunta14.required' => 'Debe seleccionar una opción para la pregunta 14.',
        'pregunta15.required' => 'Debe responder la pregunta 15.',
        'pregunta15.min' => 'La respuesta de la pregunta 15 debe tener al menos 10 caracteres.',
        'pregunta16.required' => 'Debe argumentar su respuesta en la pregunta 16.',
        'pregunta16.min' => 'La argumentación debe tener al menos 10 caracteres.',
    ];



    #[Layout('layouts.forms')]
    public function render()
    {
        $this->areas = $this->getAreasOptions();

        return view('forms.forms', [
            'areas' => $this->areas,
        ]);
    }

    public function submitForm()
    {
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Show validation error message with SweetAlert2
            $this->dispatch('sweetalert2', [
                'title' => 'Error de Validación',
                'text' => 'Por favor, complete todos los campos requeridos correctamente.',
                'icon' => 'error',
            ]);
            $this->validate();
            return;
        }

        try {
            // Create new form record
            FormApegoEtico::create([
                'area' => $this->area_seleccionada,
                'pregunta1' => $this->pregunta1,
                'pregunta2' => $this->pregunta2,
                'pregunta3' => $this->pregunta3,
                'pregunta4' => $this->pregunta4,
                'pregunta5' => $this->pregunta5,
                'pregunta6' => $this->pregunta6,
                'pregunta7' => $this->pregunta7,
                'pregunta8' => $this->pregunta8,
                'pregunta9' => $this->pregunta9,
                'pregunta10' => $this->pregunta10,
                'principios' => $this->principios,
                'pregunta11_explicacion' => $this->pregunta11_explicacion,
                'pregunta12' => $this->pregunta12,
                'pregunta13' => $this->pregunta13,
                'pregunta13_explicacion' => $this->pregunta13_explicacion,
                'pregunta14' => $this->pregunta14,
                'pregunta15' => $this->pregunta15,
                'pregunta16' => $this->pregunta16,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            $this->dispatch('sweetalert2', [
                'title' => '¡Encuesta Enviada!',
                'text' => 'Gracias por su participación. Su respuesta ha sido registrada exitosamente.',
                'icon' => 'success', // Nombre del evento Livewire para manejar la respuesta
            ]);

            // Reset form
            $this->reset();

        } catch (\Exception $e) {

            $this->dispatch('sweetalert2', [
                'title' => 'Error',
                'text' => 'Error al enviar la encuesta. Por favor, inténtelo nuevamente.',
                'icon' => 'error', // Nombre del evento Livewire para manejar la respuesta
            ]);
        }
    }

        public function checkPrincipiosLimit()
    {
        // Ensure only 3 principles can be selected
        if (count($this->principios) > 3) {
            $this->principios = array_slice($this->principios, 0, 3);

            // Show warning message

            $this->dispatch('sweetalert2', [
                'title' => 'Límite Alcanzado',
                'text' => 'Solo puede seleccionar máximo 3 principios constitucionales.',
                'icon' => 'warning', // Nombre del evento Livewire para manejar la respuesta
            ]);

        }
    }

    private function getAreasOptions(): array
    {
        return cache()->remember('areas_options', 300, function () {
            // Eager load the dependency relationship to avoid N+1 queries
            $areas = Areas::with('dependency')->get();

            return $areas->map(function ($area) {
                // Use 'id_area' field for value and 'name' + dependency name for display
                $dependencyName = $area->dependency ? $area->dependency->dependence_name : 'Unknown Dependency';
                $displayName = $area->name . ' - ' . $dependencyName;
                $systemName = $area->id_area;

                return [
                    'value' => $systemName,
                    'text' => $displayName
                ];
            })->toArray();
        });
    }

}
