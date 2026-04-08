<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloFormativo extends Model
{
    use HasFactory;

    // Al usar protected $table, le digo a laravel que busque ese nombre de tabla por defecto
    protected $table = 'ciclos_formativos';

    // aquí declaro los campos que puedo llenar a través de formularios

    protected $fillable = [
        'nombre',
        'familia_profesional',
        'grado',
        'modalidad',
        'decreto_referencia',
        'activo',
    ];

    //casteo activo a booleano automáticamente
    protected $casts = [
        'activo' => 'boolean',
    ];


    // Con esta función hago la relación de ciclos a programaciones, un ciclo puede tener muchas programaciones
    public function programaciones()
    {
        return $this->hasMany(ProgramacionDidactica::class, 'ciclo_formativo_id');
    }
}
