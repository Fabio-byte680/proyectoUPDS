<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validamos que haya nombre_usuario y password
        $credentials = $request->validate([
            'nombre_usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Intentamos autenticar usando nombre_usuario
        if (Auth::attempt([
            'nombre_usuario' => $credentials['nombre_usuario'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->withErrors([
            'nombre_usuario' => 'El nombre de usuario o la contraseña son incorrectos.',
        ])->onlyInput('nombre_usuario');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Sesión cerrada correctamente.');
    }
}
