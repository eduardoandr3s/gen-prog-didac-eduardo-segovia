<?php

namespace Database\Seeders;

use App\Models\CicloFormativo;
use App\Models\ProgramacionDidactica;
use Illuminate\Database\Seeder;

class ProgramacionDidacticaSeeder extends Seeder
{
    /**
     * Carga 2 programaciones didácticas de ejemplo asociadas al ciclo DAW.
     */
    public function run(): void
    {
        // Buscar daw por nombre
        $cicloDAW = CicloFormativo::where('nombre', 'Desarrollo de Aplicaciones Web')->first();

        // Si no existe, no se crea el seeder, aborto de la gestión

        if (!$cicloDAW) {
            $this->command->warn('Saltando ProgramacionDidacticaSeeder: no se encontró el ciclo "Desarrollo de Aplicaciones Web".');
            return;
        }

        // Primera programación: Desarrollo Web en Entorno Servidor (160h del BOE).
        ProgramacionDidactica::create([
            'titulo' => 'Programación de Desarrollo Web en Entorno Servidor',
            'modulo' => 'Desarrollo Web en Entorno Servidor',
            'ciclo_formativo_id' => $cicloDAW->id,
            'curso_academico' => '2025-2026',
            'docente' => 'Profesor Demo',
            'horas_totales' => 160,
            'objetivos' => 'Desarrollar aplicaciones web con acceso a bases de datos. Conocer los fundamentos de PHP y frameworks MVC.',
            'contenidos' => 'Tema 1: Introducción a PHP. Tema 2: Bases de datos con PDO. Tema 3: Framework Laravel. Tema 4: APIs REST.',
            'metodologia' => 'Aprendizaje basado en proyectos con desarrollo incremental y metodologías ágiles.',
            'criterios_evaluacion' => 'Exámenes prácticos (40%), proyecto final (40%), participación y entregas (20%).',
            'instrumentos_evaluacion' => 'Rúbricas de evaluación, pruebas prácticas en ordenador, revisión de código en GitHub.',
            'recursos_materiales' => 'Ordenadores del aula, XAMPP, Visual Studio Code, acceso a GitHub.',
            'atencion_diversidad' => 'Adaptación de plazos y materiales complementarios para alumnos con necesidades específicas.',
            'observaciones' => 'Programación sujeta a posibles ajustes según el ritmo del grupo.',
        ]);

        // Segunda programación: Desarrollo Web en Entorno Cliente (130h BOE).
        ProgramacionDidactica::create([
            'titulo' => 'Programación de Desarrollo Web en Entorno Cliente',
            'modulo' => 'Desarrollo Web en Entorno Cliente',
            'ciclo_formativo_id' => $cicloDAW->id,
            'curso_academico' => '2025-2026',
            'docente' => 'Profesor Demo',
            'horas_totales' => 130,
            'objetivos' => 'Dominar JavaScript y frameworks frontend. Crear interfaces web interactivas y accesibles.',
            'contenidos' => 'Tema 1: JavaScript ES6+. Tema 2: DOM y eventos. Tema 3: AJAX y Fetch API. Tema 4: Frameworks frontend.',
            'metodologia' => 'Clases prácticas con ejercicios guiados y proyecto integrador.',
            'criterios_evaluacion' => 'Prácticas semanales (30%), exámenes (30%), proyecto final (40%).',
            'instrumentos_evaluacion' => 'Corrección automática de ejercicios, rúbricas de proyecto, exámenes en ordenador.',
            'recursos_materiales' => 'Navegadores web, VS Code, Node.js, documentación MDN.',
            'atencion_diversidad' => 'Materiales de refuerzo y tutorías individualizadas.',
            'observaciones' => '',
        ]);
    }
}
