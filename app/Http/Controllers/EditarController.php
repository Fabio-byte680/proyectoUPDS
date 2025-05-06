<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Cita;
use App\Models\Personal;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EditarController extends Controller
{
    /**
     * Mostrar la vista para editar los registros de Pacientes, Citas, Personal y Especialidades
     */
    public function index()
    {
        return view('editar.index');
    }

    /**
     * Editar un paciente
     */
    public function editPaciente($id)
    {
        $paciente = Paciente::find($id);
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Editar una cita
     */
    public function editCita($id)
    {
        $cita = Cita::find($id);
        return view('citas.edit', compact('cita'));
    }

    /**
     * Editar un personal
     */
    public function editPersonal($id)
    {
        $personal = Personal::find($id);
        return view('personal.edit', compact('personal'));
    }

    /**
     * Editar una especialidad
     */
    public function editEspecialidad($id)
    {
        $especialidad = Especialidad::find($id);
        return view('especialidades.edit', compact('especialidad'));
    }

    /**
     * Actualizar el registro según el tipo (paciente, personal, cita, especialidad)
     */
    public function update(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'id' => 'required|integer',
        ]);

        // Lógica para actualizar según el tipo
        if ($request->tipo == 'paciente') {
            $paciente = Paciente::find($request->id);
            if ($paciente) {
                $paciente->update($request->all());
            }
        } elseif ($request->tipo == 'cita') {
            $cita = Cita::find($request->id);
            if ($cita) {
                $cita->update($request->all());
            }
        } elseif ($request->tipo == 'personal') {
            $personal = Personal::find($request->id);
            if ($personal) {
                $personal->update($request->all());
            }
        } elseif ($request->tipo == 'especialidad') {
            $especialidad = Especialidad::find($request->id);
            if ($especialidad) {
                $especialidad->update($request->all());
            }
        }

        return redirect()->route('editar.index')->with('success', 'Registro actualizado correctamente.');
    }
}
