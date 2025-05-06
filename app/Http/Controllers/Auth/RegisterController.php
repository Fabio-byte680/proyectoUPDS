<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'nombre_usuario' => 'required|string|max:255|unique:users,nombre_usuario',
            'correo_electronico' => 'required|email|max:255|unique:users,correo_electronico',
            'password' => 'required|string|min:6|confirmed',
            'rol' => 'required|string|in:administrador,medico,enfermero,secretaria,coordinador',
        ]);

        $user = User::create([
            'nombre_completo' => $validated['nombre_completo'],
            'nombre_usuario' => $validated['nombre_usuario'],
            'correo_electronico' => $validated['correo_electronico'],
            'password' => Hash::make($validated['password']),
            'rol' => $validated['rol'],
        ]);

        auth()->login($user);

        return redirect()->route('dashboard')->with('success', '¡Registro exitoso!');
    }
}
