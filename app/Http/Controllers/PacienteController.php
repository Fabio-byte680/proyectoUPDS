<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PacienteController extends Controller
{
    // Mostrar lista de pacientes con búsqueda
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');
        $pacientes = Paciente::where('nombre', 'like', "%$busqueda%")
                             ->orWhere('apellido', 'like', "%$busqueda%")
                             ->orWhere('dni', 'like', "%$busqueda%")
                             ->orWhere('sexo', 'like', "%$busqueda%")
                             ->paginate(10);

        return view('pacientes.index', compact('pacientes', 'busqueda'));
    }

    // Mostrar formulario para registrar nuevo paciente
    public function create()
    {
        return view('pacientes.create');
    }

    // Guardar nuevo paciente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:pacientes,dni',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:masculino,femenino,otro',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
        ]);

        Paciente::create($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado correctamente.');
    }

    // Mostrar detalles de un paciente con relaciones (triajes y citas)
    public function show($id)
    {
        $paciente = Paciente::with(['triajesEnfermeros', 'triajesMedicos', 'citas'])->findOrFail($id);
        return view('pacientes.show', compact('paciente'));
    }

    // Mostrar formulario de edición
    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    // Actualizar información del paciente
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:pacientes,dni,' . $paciente->id,
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:masculino,femenino,otro',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    // Eliminar un paciente y su foto
    public function destroy(Paciente $paciente)
    {
        if ($paciente->foto && Storage::disk('public')->exists('fotos/' . $paciente->foto)) {
            Storage::disk('public')->delete('fotos/' . $paciente->foto);
        }

        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }

    // Subir nueva foto de perfil
    public function subirFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $paciente = Paciente::findOrFail($id);

        if ($request->hasFile('foto')) {
            $archivo = $request->file('foto');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->storeAs('fotos', $nombreArchivo, 'public');

            // Eliminar foto anterior si existe
            if ($paciente->foto && Storage::disk('public')->exists('fotos/' . $paciente->foto)) {
                Storage::disk('public')->delete('fotos/' . $paciente->foto);
            }

            $paciente->foto = $nombreArchivo;
            $paciente->save();
        }

        return redirect()->route('pacientes.show', $paciente->id)
                         ->with('success', 'Foto de perfil actualizada correctamente.');
    }

    // Eliminar foto de perfil
    public function eliminarFoto($id)
    {
        $paciente = Paciente::findOrFail($id);

        if ($paciente->foto && Storage::disk('public')->exists('fotos/' . $paciente->foto)) {
            Storage::disk('public')->delete('fotos/' . $paciente->foto);
            $paciente->foto = null;
            $paciente->save();
        }

        return redirect()->route('pacientes.show', $paciente->id)
                         ->with('success', 'La foto de perfil fue eliminada correctamente.');
    }

    // Exportar PDF de la ficha del paciente
    public function exportarPDF($id)
    {
        $paciente = Paciente::with(['triajesEnfermeros', 'triajesMedicos', 'citas'])->findOrFail($id);
        $pdf = Pdf::loadView('pacientes.pdf', compact('paciente'));

        return $pdf->download('FichaPaciente_' . $paciente->dni . '.pdf');
    }
}
