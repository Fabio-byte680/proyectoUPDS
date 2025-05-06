<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Cita;
use App\Models\Personal;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EliminarController extends Controller
{
    /**
     * Mostrar la vista para eliminar los registros de Pacientes, Citas, Personal y Especialidades
     */
    public function index()
    {
        return view('eliminar.index');
    }

    /**
     * Eliminar un paciente
     */
    public function destroyPaciente($id)
    {
        $paciente = Paciente::find($id);
        if ($paciente) {
            $paciente->delete();
            return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente');
        }
        return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado');
    }

    /**
     * Eliminar una cita
     */
    public function destroyCita($id)
    {
        $cita = Cita::find($id);
        if ($cita) {
            $cita->delete();
            return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente');
        }
        return redirect()->route('citas.index')->with('error', 'Cita no encontrada');
    }

    /**
     * Eliminar un personal
     */
    public function destroyPersonal($id)
    {
        $personal = Personal::find($id);
        if ($personal) {
            $personal->delete();
            return redirect()->route('personal.index')->with('success', 'Personal eliminado correctamente');
        }
        return redirect()->route('personal.index')->with('error', 'Personal no encontrado');
    }

    /**
     * Eliminar una especialidad
     */
    public function destroyEspecialidad($id)
    {
        $especialidad = Especialidad::find($id);
        if ($especialidad) {
            $especialidad->delete();
            return redirect()->route('especialidades.index')->with('success', 'Especialidad eliminada correctamente');
        }
        return redirect()->route('especialidades.index')->with('error', 'Especialidad no encontrada');
    }

    /**
     * Lógica general para eliminar registros según el tipo (paciente, personal, cita, especialidad)
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'id' => 'required|integer',
        ]);

        // Lógica para eliminar según el tipo
        if ($request->tipo == 'paciente') {
            $paciente = Paciente::find($request->id);
            if ($paciente) {
                $paciente->delete();
            }
            return redirect()->route('eliminar.index')->with('success', 'Paciente eliminado correctamente');
        } elseif ($request->tipo == 'cita') {
            $cita = Cita::find($request->id);
            if ($cita) {
                $cita->delete();
            }
            return redirect()->route('eliminar.index')->with('success', 'Cita eliminada correctamente');
        } elseif ($request->tipo == 'personal') {
            $personal = Personal::find($request->id);
            if ($personal) {
                $personal->delete();
            }
            return redirect()->route('eliminar.index')->with('success', 'Personal eliminado correctamente');
        } elseif ($request->tipo == 'especialidad') {
            $especialidad = Especialidad::find($request->id);
            if ($especialidad) {
                $especialidad->delete();
            }
            return redirect()->route('eliminar.index')->with('success', 'Especialidad eliminada correctamente');
        }

        return redirect()->route('eliminar.index')->with('error', 'Tipo de registro no válido');
    }
}
