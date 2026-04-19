<?php

namespace Database\Seeders;

use App\Models\CicloFormativo;
use Illuminate\Database\Seeder;

class CicloFormativoSeeder extends Seeder
{
    /**
     * Carga 10 ciclos formativos de ejemplo.
     */
    public function run(): void
    {
        $ciclos = [
            // ───── Familia: Informática y Comunicaciones ─────
            [
                'nombre' => 'Desarrollo de Aplicaciones Web',
                'familia_profesional' => 'Informática y Comunicaciones',
                'grado' => 'Grado Superior',
                'modalidad' => 'Presencial',
                'decreto_referencia' => 'RD 405/2023, de 29 de mayo',
                'activo' => true,
            ],
            [
                'nombre' => 'Desarrollo de Aplicaciones Multiplataforma',
                'familia_profesional' => 'Informática y Comunicaciones',
                'grado' => 'Grado Superior',
                'modalidad' => 'Semipresencial',
                'decreto_referencia' => 'RD 450/2010, de 16 de abril',
                'activo' => true,
            ],
            [
                'nombre' => 'Administración de Sistemas Informáticos en Red',
                'familia_profesional' => 'Informática y Comunicaciones',
                'grado' => 'Grado Superior',
                'modalidad' => 'Presencial',
                'decreto_referencia' => 'RD 1629/2009, de 30 de octubre',
                'activo' => true,
            ],
            [
                'nombre' => 'Sistemas Microinformáticos y Redes',
                'familia_profesional' => 'Informática y Comunicaciones',
                'grado' => 'Grado Medio',
                'modalidad' => 'Presencial',
                'decreto_referencia' => 'RD 1691/2007, de 14 de diciembre',
                'activo' => true,
            ],

            // ───── Familia: Administración y Gestión ─────
            [
                'nombre' => 'Administración y Finanzas',
                'familia_profesional' => 'Administración y Gestión',
                'grado' => 'Grado Superior',
                'modalidad' => 'Presencial',
                'decreto_referencia' => 'RD 1584/2011, de 4 de noviembre',
                'activo' => true,
            ],
            [
                'nombre' => 'Gestión Administrativa',
                'familia_profesional' => 'Administración y Gestión',
                'grado' => 'Grado Medio',
                'modalidad' => 'Semipresencial',
                'decreto_referencia' => 'RD 1631/2009, de 30 de octubre',
                'activo' => true,
            ],

            // ───── Familia: Comercio y Marketing ─────
            [
                'nombre' => 'Marketing y Publicidad',
                'familia_profesional' => 'Comercio y Marketing',
                'grado' => 'Grado Superior',
                'modalidad' => 'Presencial',
                'decreto_referencia' => 'RD 1571/2011, de 4 de noviembre',
                'activo' => true,
            ],

            // ───── Familia: Sanidad ─────
            [
                'nombre' => 'Cuidados Auxiliares de Enfermería',
                'familia_profesional' => 'Sanidad',
                'grado' => 'Grado Medio',
                'modalidad' => 'Presencial',
                'decreto_referencia' => 'RD 546/1995, de 7 de abril',
                'activo' => true,
            ],

            // ───── Familia: Electricidad y Electrónica ─────
            [
                'nombre' => 'Sistemas Electrotécnicos y Automatizados',
                'familia_profesional' => 'Electricidad y Electrónica',
                'grado' => 'Grado Superior',
                'modalidad' => 'Presencial',
                'decreto_referencia' => 'RD 1127/2010, de 10 de septiembre',
                'activo' => true,
            ],

            // ───── Ciclo INACTIVO para probar el badge "Inactivo" ─────
            [
                'nombre' => 'Técnico en Explotación de Sistemas Informáticos',
                'familia_profesional' => 'Informática y Comunicaciones',
                'grado' => 'Grado Medio',
                'modalidad' => 'Presencial',
                'decreto_referencia' => 'RD 497/2003, de 2 de mayo',
                'activo' => false,
            ],
        ];

        // Inserta todos los ciclos en la base de datos.
        foreach ($ciclos as $ciclo) {
            CicloFormativo::create($ciclo);
        }
    }
}
