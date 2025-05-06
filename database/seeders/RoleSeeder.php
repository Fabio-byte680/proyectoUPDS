<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nombre_completo' => 'Administrador',
                'nombre_usuario' => 'admin',
                'correo_electronico' => 'admin@example.com',
                'contraseña' => Hash::make('admin123'),
                'rol' => 'administrador',
            ],
            [
                'nombre_completo' => 'Médico',
                'nombre_usuario' => 'medico',
                'correo_electronico' => 'medico@example.com',
                'contraseña' => Hash::make('medico123'),
                'rol' => 'medico',
            ],
            [
                'nombre_completo' => 'Enfermero',
                'nombre_usuario' => 'enfermero',
                'correo_electronico' => 'enfermero@example.com',
                'contraseña' => Hash::make('enfermero123'),
                'rol' => 'enfermero',
            ],
            [
                'nombre_completo' => 'Paciente',
                'nombre_usuario' => 'paciente',
                'correo_electronico' => 'paciente@example.com',
                'contraseña' => Hash::make('paciente123'),
                'rol' => 'usuario',
            ],
            [
                'nombre_completo' => 'Coordinador General', // NUEVO
                'nombre_usuario' => 'coordinador',
                'correo_electronico' => 'coordinador@example.com',
                'contraseña' => Hash::make('coordinador123'),
                'rol' => 'coordinador',
            ],
        ]);
    }
}
