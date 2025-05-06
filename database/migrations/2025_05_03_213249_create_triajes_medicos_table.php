<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('triajes_medicos', function (Blueprint $table) {
            $table->id();

            // Relación con paciente
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');

            // Datos clínicos
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('receta')->nullable();
            $table->text('observaciones')->nullable();

            // Clasificación de riesgo
            $table->enum('nivel_riesgo', ['bajo', 'moderado', 'alto', 'critico'])->default('bajo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triajes_medicos');
    }
};
