<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'personal';

    protected $fillable = [
        'nombre_completo',
        'dni',
        'telefono',
        'correo',
        'direccion',
        'cargo',
        'especialidad_id', // Se conserva como relación a tabla `especialidades`
    ];

    /**
     * Relación: un personal pertenece a una especialidad.
     */
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
