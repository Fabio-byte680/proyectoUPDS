<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'enfermero_id',
        'signos_vitales',
        'sintomas',
        'prioridad',
    ];

    // Relación: Un triaje pertenece a un paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación: Un triaje pertenece a un enfermero
    public function enfermero()
    {
        return $this->belongsTo(Usuario::class, 'enfermero_id');
    }
}
