<?php

namespace App\Http\Controllers;

use App\Models\Triaje;
use Illuminate\Http\Request;

class TriajeController extends Controller
{
    public function index()
    {
        $triajes = Triaje::all();
        return view('triajes.index', compact('triajes'));
    }

    public function create()
    {
        return view('triajes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'sintomas' => 'required|string|max:255',
            'diagnostico' => 'required|string|max:255',
        ]);

        Triaje::create($request->all());
        return redirect()->route('triajes.index');
    }

    public function show(Triaje $triaje)
    {
        return view('triajes.show', compact('triaje'));
    }

    public function edit(Triaje $triaje)
    {
        return view('triajes.edit', compact('triaje'));
    }

    public function update(Request $request, Triaje $triaje)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'sintomas' => 'required|string|max:255',
            'diagnostico' => 'required|string|max:255',
        ]);

        $triaje->update($request->all());
        return redirect()->route('triajes.index');
    }

    public function destroy(Triaje $triaje)
    {
        $triaje->delete();
        return redirect()->route('triajes.index');
    }
}
