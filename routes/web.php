<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\TriajeController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\TriajeEnfermeroController;
use App\Http\Controllers\TriajeMedicoController;
use App\Http\Controllers\EditarController;
use App\Http\Controllers\EliminarController;

// Ruta inicial
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// Rutas de autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pacientes
    Route::resource('pacientes', PacienteController::class);
    Route::post('/pacientes/{id}/subir-foto', [PacienteController::class, 'subirFoto'])->name('pacientes.subirFoto');
    Route::get('/pacientes/{paciente}/ficha-pdf', [PacienteController::class, 'descargarFichaPdf'])->name('pacientes.fichaPdf');

    // Citas
    Route::resource('citas', CitaController::class);

    // Personal
    Route::resource('personal', PersonalController::class);

    // Especialidades
    Route::resource('especialidades', EspecialidadController::class);

   // Triaje Enfermero
Route::resource('triajes_enfermeros', TriajeEnfermeroController::class)->except(['show']);
Route::get('triajes_enfermeros/{id}', [TriajeEnfermeroController::class, 'show'])->name('triajes_enfermeros.show');
Route::get('triaje_enfermero', [TriajeEnfermeroController::class, 'index'])->name('triaje_enfermero.index');

// Triaje Médico
Route::resource('triajes_medicos', TriajeMedicoController::class)->except(['show']);
Route::get('triajes_medicos/{id}', [TriajeMedicoController::class, 'show'])->name('triajes_medicos.show');
Route::get('triaje_medico', [TriajeMedicoController::class, 'index'])->name('triaje_medico.index');



    // Edición
    Route::get('editar', [EditarController::class, 'index'])->name('editar.index');

    // Rutas duplicadas con resource (comentadas para evitar conflictos)
    // Route::get('pacientes/{id}/editar', [PacienteController::class, 'edit'])->name('pacientes.edit');
    // Route::get('citas/{id}/editar', [CitaController::class, 'edit'])->name('citas.edit');
    // Route::get('personal/{id}/editar', [PersonalController::class, 'edit'])->name('personal.edit');
    // Route::get('especialidades/{id}/editar', [EspecialidadController::class, 'edit'])->name('especialidades.edit');

    // Eliminación
    Route::get('eliminar', [EliminarController::class, 'index'])->name('eliminar.index');

     //Duplicadas con resource (comentadas para evitar conflictos)
    // Route::delete('pacientes/{id}', [PacienteController::class, 'destroy'])->name('pacientes.destroy');
    // Route::delete('citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
    // Route::delete('personal/{id}', [PersonalController::class, 'destroy'])->name('personal.destroy');
    // Route::delete('especialidades/{id}', [EspecialidadController::class, 'destroy'])->name('especialidades.destroy');

    // Administrador
    Route::middleware('role:administrador')->group(function () {
        Route::get('usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('usuarios/{user}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('usuarios/{user}', [UserController::class, 'update'])->name('usuarios.update');
        Route::delete('usuarios/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');

        Route::delete('/pacientes/{id}/eliminar-foto', [PacienteController::class, 'eliminarFoto'])->name('pacientes.eliminarFoto');
        Route::get('/pacientes/{id}/exportar-pdf', [PacienteController::class, 'exportarPDF'])->name('pacientes.exportarPDF');
        
        Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

        Route::resource('citas', CitaController::class);
        



    });
});
