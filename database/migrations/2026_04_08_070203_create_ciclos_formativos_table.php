<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * CREA LA TABLA
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ciclos_formativos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('familia_profesional', 100);
            $table->string('grado', 50);
            $table->string('modalidad', 80);
            $table->string('decreto_referencia', 250)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. ELIMINA LA TABLA
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclos_formativos');
    }
};
