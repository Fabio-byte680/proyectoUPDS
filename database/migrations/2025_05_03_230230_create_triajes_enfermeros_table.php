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
        Schema::create('triajes_enfermeros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')  // Columna que relaciona con la tabla pacientes
                  ->constrained('pacientes')  // Asegura que la columna paciente_id se relaciona con la tabla pacientes
                  ->onDelete('cascade');  // Elimina los triajes si el paciente es eliminado
            $table->decimal('temperatura', 5, 2)->nullable(); // Temperatura (por ejemplo, 37.5)
            $table->integer('frecuencia_cardiaca')->nullable(); // Frecuencia cardíaca
            $table->integer('frecuencia_respiratoria')->nullable(); // Frecuencia respiratoria
            $table->decimal('saturacion_oxigeno', 5, 2)->nullable(); // Saturación de oxígeno
            $table->enum('nivel_riesgo', ['bajo', 'moderado', 'alto', 'critico'])->default('bajo'); // Nivel de riesgo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triajes_enfermeros');
    }
};
