<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TriajeEnfermero;
use App\Models\Paciente;

class TriajeEnfermeroController extends Controller
{
    /**
     * Muestra una lista de triajes de enfermería.
     */
    public function index()
    {
        $triajes = TriajeEnfermero::with('paciente')->latest()->get();
        return view('triajes_enfermeros.index', compact('triajes'));
    }

    /**
     * Muestra el formulario para crear un nuevo triaje.
     */
    public function create()
    {
        $pacientes = Paciente::all();
        return view('triajes_enfermeros.create', compact('pacientes'));
    }

    /**
     * Guarda un nuevo triaje en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'temperatura' => 'required|numeric',
            'frecuencia_cardiaca' => 'required|integer',
            'frecuencia_respiratoria' => 'required|integer',
            'saturacion_oxigeno' => 'required|numeric',
            'observaciones' => 'nullable|string',
        ]);

        // Crear y guardar el triaje
        $triaje = new TriajeEnfermero($data);
        $triaje->calcularNivelRiesgo(); // Calcular el nivel de riesgo automáticamente
        $triaje->save();

        return redirect()->route('triajes_enfermeros.create')->with('success', 'Triaje de enfermería guardado correctamente.');
    }

    /**
     * Muestra los detalles de un triaje específico.
     */
    public function show($id)
    {
        $triaje = TriajeEnfermero::with('paciente')->findOrFail($id);
        return view('triajes_enfermeros.show', compact('triaje'));
    }

    /**
     * Muestra el formulario para editar un triaje de enfermería.
     */
    public function edit($id)
    {
        // Recuperar el triaje y los pacientes para el formulario
        $triaje = TriajeEnfermero::with('paciente')->findOrFail($id);
        $pacientes = Paciente::all();
        return view('triajes_enfermeros.edit', compact('triaje', 'pacientes'));
    }

    /**
     * Actualiza un triaje de enfermería en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'temperatura' => 'required|numeric',
            'frecuencia_cardiaca' => 'required|integer',
            'frecuencia_respiratoria' => 'required|integer',
            'saturacion_oxigeno' => 'required|numeric',
            'observaciones' => 'nullable|string',
        ]);

        // Encontrar el triaje y actualizar
        $triaje = TriajeEnfermero::findOrFail($id);
        $triaje->update($data);
        $triaje->calcularNivelRiesgo(); // Recalcular el nivel de riesgo
        $triaje->save();

        return redirect()->route('triajes_enfermeros.index')->with('success', 'Triaje de enfermería actualizado correctamente.');
    }
}
