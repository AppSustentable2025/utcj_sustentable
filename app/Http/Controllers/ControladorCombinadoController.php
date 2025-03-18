<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Alumno;

class ControladorCombinadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function ejecutarTodasLasFunciones(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'alumnos' => 'required|array',
            'alumnos.*.matricula' => 'required|string',
            'alumnos.*.nombre' => 'required|string',
        ]);

        // Resultados de cada función
        $resultadoRegistrarAlumnos = $this->registrarAlumnos($request);
        $resultadoRegistrarActividad = $this->registrarActividad($request);
        
        // Combinar los mensajes de éxito
        $mensajeAlumnos = session('success_alumnos', '');
        $mensajeActividad = session('success_actividad', '');
        
        // Devolver una respuesta combinada
        return redirect()->back()->with('success', $mensajeAlumnos . ' ' . $mensajeActividad);
    }

    private function registrarAlumnos(Request $request)
    {
        $alumnosCreados = 0;
        $alumnosExistentes = 0;
        $alumnos = $request->alumnos;
        
        foreach ($alumnos as $alumnoData) {
            // Verificar si el alumno ya existe
            $alumnoExistente = Alumno::where('matricula', $alumnoData['matricula'])->first();
            
            if ($alumnoExistente) {
                $alumnosExistentes++;
                continue;
            }
            
            // Generar una contraseña alfanumérica aleatoria de 8 caracteres
            $password = $this->generarPassword();
            
            // Crear el nuevo alumno
            $alumno = new Alumno();
            $alumno->matricula = $alumnoData['matricula'];
            $alumno->nombre = $alumnoData['nombre'];
            $alumno->password = bcrypt($password); // Encriptar la contraseña
            $alumno->save();
            
            $alumnosCreados++;
        }
        
        $mensaje = "Se han creado $alumnosCreados cuentas de alumnos correctamente. $alumnosExistentes ya existían.";
        session()->flash('success_alumnos', $mensaje);
        
        return $mensaje;
    }
    
    private function registrarActividad(Request $request)
    {
        $alumnos = $request->input('alumnos', []);
        
        if (empty($alumnos)) {
            session()->flash('error_actividad', 'No hay alumnos cargados para crear una actividad.');
            return 'No hay alumnos cargados para crear una actividad.';
        }
        
        // Obtener la primera fila de alumnos
        $primerAlumno = reset($alumnos);
        
        // Verificar si existen las claves "Periodo" y "Horario"
        if (!isset($primerAlumno['Periodo']) || !isset($primerAlumno['Horario'])) {
            session()->flash('error_actividad', 'Faltan datos de Periodo u Horario en la lista de alumnos.');
            return 'Faltan datos de Periodo u Horario en la lista de alumnos.';
        }
        
        // Crear la actividad en la base de datos
        $actividad = Actividad::create([
            'Periodo' => $primerAlumno['Periodo'],
            'Horario' => $primerAlumno['Horario']
        ]);
        
        $mensaje = 'Actividad creada exitosamente.';
        session()->flash('success_actividad', $mensaje);
        
        return $mensaje;
    }
    
    /**
     * Genera una contraseña alfanumérica aleatoria.
     *
     * @param  int  $length
     * @return string
     */
    private function generarPassword($length = 8)
    {
        // Caracteres permitidos para la contraseña (alfanuméricos)
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $passwordLength = strlen($caracteres);
        $password = '';
        
        // Generar la contraseña aleatoria
        for ($i = 0; $i < $length; $i++) {
            $password .= $caracteres[rand(0, $passwordLength - 1)];
        }
        
        return $password;
    }
}
