<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre_completo',
        'nombre_usuario',
        'correo_electronico',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ✅ Indicamos que el username será 'nombre_usuario'
    public function username()
    {
        return 'nombre_usuario';
    }
    
}
