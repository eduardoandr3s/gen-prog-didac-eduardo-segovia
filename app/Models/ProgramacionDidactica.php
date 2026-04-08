<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramacionDidactica extends Model
{
    use HasFactory;

    // Al usar protected $table, le digo a laravel que busque ese nombre de tabla por defecto

    protected $table = 'programaciones_didacticas';



    // aquí declaro los campos que puedo llenar

    protected $fillable = [
        'titulo',
        'modulo',
        'ciclo_formativo_id',
        'curso_academico',
        'docente',
        'horas_totales',
        'objetivos',
        'contenidos',
        'metodologia',
        'criterios_evaluacion',
        'instrumentos_evaluacion',
        'recursos_materiales',
        'atencion_diversidad',
        'observaciones',
    ];

// relación, una progrmación pertenece a un solo ciclo formativo
    public function cicloFormativo()
    {
        return $this->belongsTo(CicloFormativo::class, 'ciclo_formativo_id');
    }
}
