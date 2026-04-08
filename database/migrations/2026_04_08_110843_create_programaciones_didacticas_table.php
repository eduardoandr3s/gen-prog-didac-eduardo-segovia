<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * COn esta function CREO la tabla con todos sus campos
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programaciones_didacticas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->string('modulo', 150);
            $table->foreignId('ciclo_formativo_id')
                ->constrained('ciclos_formativos')
                ->onDelete('cascade');
            $table->string('curso_academico', 20);
            $table->string('docente', 150);
            $table->integer('horas_totales');
            $table->text('objetivos')->nullable();
            $table->text('contenidos')->nullable();
            $table->text('metodologia')->nullable();
            $table->text('criterios_evaluacion')->nullable();
            $table->text('instrumentos_evaluacion')->nullable();
            $table->text('recursos_materiales')->nullable();
            $table->text('atencion_diversidad')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Elimino la tabla con esta function
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programaciones_didacticas');
    }
};
