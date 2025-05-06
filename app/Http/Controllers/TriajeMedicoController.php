<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TriajeMedico;
use App\Models\Paciente;

class TriajeMedicoController extends Controller
{
    /**
     * Muestra una lista de triajes médicos.
     */
    public function index()
    {
        $triajes = TriajeMedico::with('paciente')->latest()->get();
        return view('triajes_medicos.index', compact('triajes'));
    }

    /**
     * Muestra el formulario para crear un nuevo triaje médico.
     */
    public function create()
    {
        $pacientes = Paciente::all();
        return view('triajes_medicos.create', compact('pacientes'));
    }

    /**
     * Guarda un nuevo triaje médico en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'diagnostico' => 'required|string',
            'tratamiento' => 'nullable|string',
            'receta' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'nivel_riesgo' => 'required|in:bajo,moderado,alto,critico',
        ]);

        TriajeMedico::create($data);

        return redirect()->route('triajes_medicos.create')->with('success', 'Triaje médico guardado correctamente.');
    }

    /**
     * Muestra los detalles de un triaje médico específico.
     */
    public function show($id)
    {
        $triaje = TriajeMedico::with('paciente')->findOrFail($id);
        return view('triajes_medicos.show', compact('triaje'));
    }

    /**
     * Muestra el formulario para editar un triaje médico.
     */
    public function edit($id)
    {
        $triaje = TriajeMedico::with('paciente')->findOrFail($id);
        $pacientes = Paciente::all();
        return view('triajes_medicos.edit', compact('triaje', 'pacientes'));
    }

    /**
     * Actualiza un triaje médico en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $triaje = TriajeMedico::findOrFail($id);

        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'diagnostico' => 'required|string',
            'tratamiento' => 'nullable|string',
            'receta' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'nivel_riesgo' => 'required|in:bajo,moderado,alto,critico',
        ]);

        $triaje->update($data);

        return redirect()->route('triajes_medicos.index')->with('success', 'Triaje médico actualizado correctamente.');
    }
}
