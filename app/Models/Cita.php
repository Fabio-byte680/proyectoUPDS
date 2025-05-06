<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'especialidad',
        'fecha_cita',
        'hora_cita',
        'motivo',
    ];

    // Relación: Una cita pertenece a un paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
