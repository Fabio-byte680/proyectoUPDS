<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard según el rol del usuario.
     *
     * @return View|RedirectResponse
     */
    public function index()
    {
        $user = Auth::user();
        
        switch ($user->rol) {
            case 'administrador':
                return view('dashboard.administrador');
            case 'medico':
                return view('dashboard.medico');
            case 'enfermero':
                return view('dashboard.enfermero');
            case 'secretaria':
                return view('dashboard.secretaria');
            case 'coordinador':
                return view('dashboard.coordinador');
            default:
                return redirect('/')->with('error', 'Rol no reconocido.');
        }
    }
}
