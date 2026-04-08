<?php

namespace Database\Seeders;

use App\Models\CicloFormativo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CicloFormativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        //datos de pruebas que creará el seeder

        CicloFormativo::create([
            'nombre' => 'Desarrollo de Aplicaciones Web',
            'familia_profesional' => 'Informática y Comunicaciones',
            'grado' => 'Grado Superior',
            'modalidad' => 'Presencial',
            'decreto_referencia' => 'RD 405/2023, de 29 de mayo',
            'activo' => true,
        ]);

        CicloFormativo::create([
            'nombre' => 'Sistemas Microinformáticos y Redes',
            'familia_profesional' => 'Informática y Comunicaciones',
            'grado' => 'Grado Medio',
            'modalidad' => 'Presencial',
            'decreto_referencia' => 'RD 1691/2007',
            'activo' => true,
        ]);
    }
}
