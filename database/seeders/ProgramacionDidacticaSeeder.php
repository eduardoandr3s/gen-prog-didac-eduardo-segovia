<?php

namespace Database\Seeders;

use App\Models\ProgramacionDidactica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramacionDidacticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    //datos de pruebas que creará el seeder
        ProgramacionDidactica::create([
            'titulo' => 'Programación de Desarrollo Web en Entorno Servidor',
            'modulo' => 'Desarrollo Web en Entorno Servidor',
            'ciclo_formativo_id' => 1,
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

        ProgramacionDidactica::create([
            'titulo' => 'Programación de Desarrollo Web en Entorno Cliente',
            'modulo' => 'Desarrollo Web en Entorno Cliente',
            'ciclo_formativo_id' => 1,
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
