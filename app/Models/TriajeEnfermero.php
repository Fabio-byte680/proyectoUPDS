<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;

class TriajeEnfermero extends Model
{
    use HasFactory;

    protected $table = 'triajes_enfermeros'; // <- 👈 Solución al problema

    protected $fillable = [
        'paciente_id',
        'presion_arterial',
        'temperatura',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'saturacion_oxigeno',
        'observaciones',
        'nivel_riesgo',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function calcularNivelRiesgo()
    {
        if ($this->saturacion_oxigeno < 90 || $this->frecuencia_cardiaca > 130 || $this->temperatura >= 40) {
            $this->nivel_riesgo = 'critico';
        } elseif ($this->temperatura >= 39 || $this->frecuencia_cardiaca > 110) {
            $this->nivel_riesgo = 'alto';
        } elseif ($this->temperatura >= 38 || $this->frecuencia_cardiaca > 100) {
            $this->nivel_riesgo = 'moderado';
        } else {
            $this->nivel_riesgo = 'bajo';
        }
    }

    protected static function booted()
    {
        static::saving(function ($triaje) {
            $triaje->calcularNivelRiesgo();
        });
    }

    public function getDescripcionRiesgoAttribute()
    {
        return match ($this->nivel_riesgo) {
            'bajo' => 'Riesgo bajo - sin urgencia aparente',
            'moderado' => 'Riesgo moderado - atención pronta recomendada',
            'alto' => 'Riesgo alto - atención urgente',
            'critico' => 'Riesgo crítico - intervención inmediata',
            default => 'No clasificado',
        };
    }

    public function scopePorRiesgo($query, $nivel)
    {
        return $query->where('nivel_riesgo', $nivel);
    }
}
