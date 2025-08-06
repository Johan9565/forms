<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormApegoEtico extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'form_apego_etico';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area',
        'pregunta1',
        'pregunta2',
        'pregunta3',
        'pregunta4',
        'pregunta5',
        'pregunta6',
        'pregunta7',
        'pregunta8',
        'pregunta9',
        'pregunta10',
        'principios',
        'pregunta11_explicacion',
        'pregunta12',
        'pregunta13',
        'pregunta14',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'principios' => 'array',
    ];

    /**
     * Get the question labels for display purposes.
     *
     * @return array
     */
    public static function getQuestionLabels(): array
    {
        return [
            'pregunta1' => 'Definición de Ética Pública',
            'pregunta2' => 'Importancia del Código de Ética',
            'pregunta3' => 'Principios Constitucionales',
            'pregunta4' => 'Descripción del Código de Ética',
            'pregunta5' => 'Importancia de normas éticas',
            'pregunta6' => 'Situación específica',
            'pregunta7' => 'Acciones para fortalecer ética',
            'pregunta8' => 'Manejo de conflictos de interés',
            'pregunta9' => 'Capacitación recibida',
            'pregunta10' => 'Necesidad de capacitación',
            'principios' => 'Principios seleccionados',
            'pregunta11_explicacion' => 'Explicación de principios',
            'pregunta12' => 'Definición de valor ético',
            'pregunta13' => 'Instancias de reporte',
            'pregunta14' => 'Ejemplo del superior',
        ];
    }

    /**
     * Get the answer options for multiple choice questions.
     *
     * @return array
     */
    public static function getAnswerOptions(): array
    {
        return [
            'pregunta1' => [
                'a' => 'Conjunto de cualidades por las que una persona servidora pública es apreciada o bien considerada en el servicio público.',
                'b' => 'Disciplina basada en normas de conducta que se fundamentan en el deber público y que busca en toda decisión y acción, la prevalencia del bienestar de la sociedad en coordinación con los objetivos del Estado mexicano, de los entes públicos y de la responsabilidad de la persona ante éstos;',
                'c' => 'Ley que obliga a los servidores públicos a actuar de forma respetuosa, orientada a la legalidad, honradez y lealtad.',
            ],
            'pregunta2' => [
                'muy_importante' => 'Muy Importante',
                'poco_importante' => 'Poco importante',
                'nada_importante' => 'Nada importante',
            ],
            'pregunta3' => [
                'a' => 'Cumplir con las declaraciones patrimoniales, de intereses y fiscales.',
                'b' => 'Lealtad e imparcialidad.',
                'c' => 'Acatar las instrucciones formuladas por escrito por el jefe inmediato.',
            ],
            'pregunta5' => [
                'si' => 'Sí',
                'no' => 'No',
            ],
            'pregunta8' => [
                'a' => 'Solicitar ser excusado de participar en cualquier forma, en la atención, tramitación o resolución del asunto.',
                'b' => 'Continuar con el asunto hasta su conclusión.',
                'c' => 'Informar por escrito a la Contraloría Municipal la existencia del conflicto de intereses o impedimento legal.',
            ],
            'pregunta9' => [
                'si' => 'Sí',
                'no' => 'No',
            ],
            'pregunta10' => [
                'si' => 'Sí',
                'no' => 'No',
            ],
            'pregunta12' => [
                'etica_publica' => 'Ética Pública',
                'interes_publico' => 'Interés Público',
                'liderazgo' => 'Liderazgo',
            ],
            'pregunta13' => [
                'a' => 'Contraloría Municipal y Fiscalía Especializada en Combate a la Corrupción',
                'b' => 'Contraloría Municipal y Comité de Ética y Conducta del Municipio de Benito Juárez.',
                'c' => 'Fiscalía Especializada en Combate a la Corrupción y Comité de Ética y de Prevención de Conflictos de Interés',
            ],
        ];
    }

    /**
     * Get the constitutional principles options.
     *
     * @return array
     */
    public static function getConstitutionalPrinciples(): array
    {
        return [
            'honestidad' => 'Honestidad',
            'economia' => 'Economía',
            'lealtad' => 'Lealtad',
            'integridad' => 'Integridad',
            'eficacia' => 'Eficacia',
            'rendicion_cuentas' => 'Rendición de Cuentas',
            'objetividad' => 'Objetividad',
            'profesionalismo' => 'Profesionalismo',
            'legalidad' => 'Legalidad',
            'equidad' => 'Equidad',
            'eficiencia' => 'Eficiencia',
            'honradez' => 'Honradez',
            'competencia_merito' => 'Competencia por Mérito',
            'disciplina' => 'Disciplina',
            'imparcialidad' => 'Imparcialidad',
            'transparencia' => 'Transparencia',
        ];
    }

    /**
     * Get the formatted answer for display.
     *
     * @param string $question
     * @param string $answer
     * @return string
     */
    public static function getFormattedAnswer(string $question, string $answer): string
    {
        $options = self::getAnswerOptions();

        if (isset($options[$question][$answer])) {
            return $options[$question][$answer];
        }

        return $answer;
    }

    /**
     * Get the formatted principles for display.
     *
     * @param array $principios
     * @return array
     */
    public static function getFormattedPrinciples(array $principios): array
    {
        $allPrinciples = self::getConstitutionalPrinciples();
        $formatted = [];

        foreach ($principios as $principio) {
            if (isset($allPrinciples[$principio])) {
                $formatted[] = $allPrinciples[$principio];
            }
        }

        return $formatted;
    }
}