<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');
        $personal = Personal::where('nombre', 'like', "%$busqueda%")
                            ->orWhere('cargo', 'like', "%$busqueda%")
                            ->paginate(10);

        return view('personal.index', compact('personal', 'busqueda'));
    }

    public function create()
    {
        return view('personal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:personal,dni',
            'cargo' => 'required|string|max:100',
            'especialidad' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
        ]);

        Personal::create($request->all());
        return redirect()->route('personal.index')->with('success', 'Personal registrado correctamente.');
    }

    public function show(Personal $personal)
    {
        return view('personal.show', compact('personal'));
    }

    public function edit(Personal $personal)
    {
        return view('personal.edit', compact('personal'));
    }

    public function update(Request $request, Personal $personal)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:personal,dni,' . $personal->id,
            'cargo' => 'required|string|max:100',
            'especialidad' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
        ]);

        $personal->update($request->all());
        return redirect()->route('personal.index')->with('success', 'Información del personal actualizada correctamente.');
    }

    public function destroy(Personal $personal)
    {
        $personal->delete();
        return redirect()->route('personal.index')->with('success', 'Personal eliminado correctamente.');
    }
}
