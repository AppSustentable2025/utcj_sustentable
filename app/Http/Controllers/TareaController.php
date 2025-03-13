<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    // Mostrar la vista con las tareas
    public function index()
    {
        $tareas = Tarea::all(); // Obtener todas las tareas
        return view('lista-tareas', compact('tareas')); // Pasar las tareas a la vista
    }

    // Guardar una nueva tarea
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'integrantes' => 'nullable|string', // Validar el campo 'integrantes'
        ]);

        // Crear una nueva tarea
        Tarea::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'integrantes' => $request->integrantes,
        ]);

        // Redirigir a la misma página con un mensaje de éxito
        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:500',
        'integrantes' => 'nullable|string', // Validar el campo 'integrantes'
    ]);

    // Buscar la tarea y actualizarla
    $tarea = Tarea::findOrFail($id);
    $tarea->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'integrantes' => $request->integrantes,
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
}

public function destroy($id)
{
    // Buscar la tarea y eliminarla
    $tarea = Tarea::findOrFail($id);
    $tarea->delete();

    // Redirigir con mensaje de éxito
    return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente.');
}

}
