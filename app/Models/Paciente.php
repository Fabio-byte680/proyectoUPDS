<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Triaje;
use App\Models\TriajeEnfermero;
use App\Models\TriajeMedico;
use App\Models\Cita;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'sexo',
        'direccion',
        'telefono',
        'correo',
    ];

    // Relación: triajes generales (si aplica)
    public function triajes()
    {
        return $this->hasMany(Triaje::class);
    }

    // Relación: triajes realizados por enfermeros
    public function triajesEnfermeros()
    {
        return $this->hasMany(TriajeEnfermero::class);
    }

    // Relación: triajes realizados por médicos
    public function triajesMedicos()
    {
        return $this->hasMany(TriajeMedico::class);
    }

    // Relación: citas médicas del paciente
    public function citas()
    {
        return $this->hasMany(\App\Models\Cita::class);
    }

    // Triaje de enfermero más reciente
    public function ultimoTriajeEnfermero()
    {
        return $this->triajesEnfermeros()->latest()->first();
    }

    // Nivel de riesgo más reciente del triaje de enfermería
    public function ultimoNivelRiesgo()
    {
        $ultimoTriaje = $this->ultimoTriajeEnfermero();
        return $ultimoTriaje ? $ultimoTriaje->nivel_riesgo : null;
    }
}
