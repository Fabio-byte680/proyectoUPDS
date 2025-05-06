<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra la lista de usuarios.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para editar un usuario.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('usuarios.edit', compact('user'));
    }

    /**
     * Actualiza la información de un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'nombre_usuario' => 'required|string|max:255|unique:users,nombre_usuario,' . $user->id,
            'correo_electronico' => 'required|string|email|max:255|unique:users,correo_electronico,' . $user->id,
            'rol' => 'required|string|in:usuario,enfermero,medico,administrador,coordinador',
        ]);

        $user->update($validated);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
