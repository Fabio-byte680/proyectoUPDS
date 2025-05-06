<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\Personal;
use Illuminate\Database\Seeder;

class PersonalSeeder extends Seeder
{
    public function run()
    {
        Personal::create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'dni' => '12345678',
            'cargo' => 'Médico',
            'especialidad' => 'Pediatría',
            'telefono' => '123-4567890',
            'correo' => 'juan.perez@example.com',
        ]);

        Personal::create([
            'nombre' => 'Ana',
            'apellido' => 'Gómez',
            'dni' => '23456789',
            'cargo' => 'Enfermera',
            'especialidad' => 'General',
            'telefono' => '987-6543210',
            'correo' => 'ana.gomez@example.com',
        ]);
    }
}
