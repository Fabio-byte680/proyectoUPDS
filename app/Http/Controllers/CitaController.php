<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $citas = Cita::with('paciente')
                     ->where('motivo', 'like', "%$busqueda%")
                     ->orWhere('especialidad', 'like', "%$busqueda%")
                     ->orderBy('fecha_cita', 'desc')
                     ->paginate(10);

        return view('citas.index', compact('citas', 'busqueda'));
    }

    public function create()
    {
        $pacientes = Paciente::all();
        return view('citas.create', compact('pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id'      => 'required|exists:pacientes,id',
            'especialidad'     => 'required|string',
            'fecha_cita'       => 'required|date',
            'hora_cita'        => 'required',
            'motivo'           => 'nullable|string',
            'acepta_politica'  => 'accepted',
        ]);

        Cita::create([
            'paciente_id' => $request->paciente_id,
            'especialidad' => $request->especialidad,
            'fecha_cita' => $request->fecha_cita,
            'hora_cita' => $request->hora_cita,
            'motivo' => $request->motivo,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita registrada correctamente.');
    }

    public function show(Cita $cita)
    {
        return view('citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        $pacientes = Paciente::all();
        return view('citas.edit', compact('cita', 'pacientes'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'paciente_id'  => 'required|exists:pacientes,id',
            'especialidad' => 'required|string',
            'fecha_cita'   => 'required|date',
            'hora_cita'    => 'required',
            'motivo'       => 'nullable|string',
        ]);

        $cita->update([
            'paciente_id' => $request->paciente_id,
            'especialidad' => $request->especialidad,
            'fecha_cita' => $request->fecha_cita,
            'hora_cita' => $request->hora_cita,
            'motivo' => $request->motivo,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente.');
    }
}
