<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre_completo',
        'nombre_usuario',
        'correo_electronico',
        'contraseña',
        'rol'
    ];

    // Relación: Un enfermero tiene muchos triajes
    public function triajes()
    {
        return $this->hasMany(Triaje::class, 'enfermero_id');
    }

    // Relación: Un médico tiene muchas citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'medico_id');
    }
}
