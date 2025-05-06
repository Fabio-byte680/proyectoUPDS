<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('nombre_usuario')->unique();
            $table->string('correo_electronico')->unique();
            $table->string('password'); // corregido: antes decía 'contraseña'
            $table->string('rol'); // administrador, enfermero, médico, secretaria, etc.
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
