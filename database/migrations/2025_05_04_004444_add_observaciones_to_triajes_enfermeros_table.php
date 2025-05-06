<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega la columna 'observaciones' a la tabla triajes_enfermeros.
     */
    public function up(): void
    {
        Schema::table('triajes_enfermeros', function (Blueprint $table) {
            $table->text('observaciones')->nullable()->after('saturacion_oxigeno');
        });
    }

    /**
     * Revierta la adición de la columna 'observaciones'.
     */
    public function down(): void
    {
        Schema::table('triajes_enfermeros', function (Blueprint $table) {
            $table->dropColumn('observaciones');
        });
    }
};
