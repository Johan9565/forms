<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormApegoEtico;

class FormApegoEticoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areaIds = [
            2, 4, 7, 9, 10, 11, 12, 13, 15, 16, 18, 19, 20, 21, 22, 23, 24, 25, 28, 30,
            31, 32, 34, 35, 36, 37, 38, 39, 40, 41, 42, 45, 46, 47, 48, 49, 50, 51, 54,
            56, 57, 58, 59, 60, 61, 62, 63, 64, 66, 68, 69, 70, 71, 72, 73, 74, 75, 76,
            77, 78, 79, 80, 81
        ];

        $dependencies = [
            'Contraloría Municipal',
            'Fiscalía Especializada',
            'Comité de Ética',
            'Secretaría de Gobierno',
            'Dirección de Recursos Humanos',
            'Oficina de Transparencia',
            'Comisión de Vigilancia',
            'Unidad de Auditoría',
            'Departamento de Legal',
            'Oficina de Quejas'
        ];

        $principlesOptions = [
            'honestidad', 'economia', 'lealtad', 'integridad', 'eficacia',
            'rendicion_cuentas', 'objetividad', 'profesionalismo', 'legalidad',
            'equidad', 'eficiencia', 'honradez', 'competencia_merito',
            'disciplina', 'imparcialidad', 'transparencia'
        ];

        for ($i = 0; $i < 100; $i++) {
            $areaId = $areaIds[array_rand($areaIds)];
            $dependency = $dependencies[array_rand($dependencies)];

            // Random principles (2-5 principles per form)
            $numPrinciples = rand(2, 5);
            $principles = array_rand(array_flip($principlesOptions), $numPrinciples);
            if (!is_array($principles)) {
                $principles = [$principles];
            }

            FormApegoEtico::create([
                'area' => $areaId,
                'pregunta1' => ['a', 'b', 'c'][array_rand(['a', 'b', 'c'])],
                'pregunta2' => ['muy_importante', 'algo_importante', 'nada_importante'][array_rand(['muy_importante', 'algo_importante', 'nada_importante'])],
                'pregunta3' => ['a', 'b', 'c'][array_rand(['a', 'b', 'c'])],
                'pregunta4' => 'Descripción del código de ética y reglas de integridad del municipio de Benito Juárez.',
                'pregunta5' => ['si', 'no'][array_rand(['si', 'no'])],
                'pregunta6' => 'Situación específica donde se aplicó el código de ética.',
                'pregunta7' => 'Acciones para fortalecer la ética en el servicio público.',
                'pregunta8' => ['a', 'b', 'c'][array_rand(['a', 'b', 'c'])],
                'pregunta9' => ['si', 'no'][array_rand(['si', 'no'])],
                'pregunta10' => ['si', 'no'][array_rand(['si', 'no'])],
                'principios' => $principles,
                'pregunta11_explicacion' => 'Explicación de los principios seleccionados.',
                'pregunta12' => ['etica_publica', 'interes_publico', 'liderazgo'][array_rand(['etica_publica', 'interes_publico', 'liderazgo'])],
                'pregunta13' => ['si', 'no'][array_rand(['si', 'no'])],
                'pregunta13_explicacion' => 'Contraloría Municipal y Comité de Ética y Prevención de Conflictos de Interés.',
                'pregunta14' => ['a', 'b', 'c'][array_rand(['a', 'b', 'c'])],
                'pregunta15' => 'Conocimiento sobre los miembros del comité de ética y sus funciones.',
                'pregunta16' => 'Ejemplo de comportamiento ético del superior inmediato.',
                'ip_address' => '192.168.1.' . rand(1, 255),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            ]);
        }
    }
}
