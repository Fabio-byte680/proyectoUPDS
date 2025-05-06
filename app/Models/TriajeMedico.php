<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;

class TriajeMedico extends Model
{
    use HasFactory;

    // ⚠️ Forzamos el nombre correcto de la tabla
    protected $table = 'triajes_medicos';

    protected $fillable = [
        'paciente_id',
        'diagnostico',
        'tratamiento',
        'receta',
        'observaciones',
        'nivel_riesgo',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function getDescripcionRiesgoAttribute()
    {
        return match ($this->nivel_riesgo) {
            'bajo' => 'Riesgo bajo - sin urgencia',
            'moderado' => 'Riesgo moderado - observar evolución',
            'alto' => 'Riesgo alto - requiere intervención',
            'critico' => 'Riesgo crítico - atención inmediata',
            default => 'No clasificado',
        };
    }

    public function scopePorRiesgo($query, $nivel)
    {
        return $query->where('nivel_riesgo', $nivel);
    }
}
