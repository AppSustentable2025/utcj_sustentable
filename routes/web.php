<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\TareaListarController;
use App\Http\Controllers\AlumnoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard'); // Asegúrate de tener esta vista en resources/views
})->name('dashboard');

///Tareas
/* Despues de name, no pueden llamarse igual las rutas mas de una vez */

Route::get('/lista-tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');
Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');

///Lista de tareas
Route::get('/crear-actividad', [TareaController::class, 'show']);

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

///Rutas views
Route::get('/lista-actividades', function () {
    return view('lista-actividades');
});

///Ruta Crear Tarea
Route::get('/crear-actividades', [TareaListarController::class, 'index'])->name('actividades.create');

Route::resource('tareas', TareaController::class);

// Ruta para registrar alumnos
Route::post('/alumnos/registrar', [AlumnoController::class, 'registrar'])->name('alumnos.registrar');