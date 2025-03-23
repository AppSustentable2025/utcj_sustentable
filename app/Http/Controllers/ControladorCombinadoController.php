<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Actividad;
use App\Models\Alumno;
use App\Models\AlumnoTarea;
use App\Models\Tarea;
use App\Models\ActividadAlumno;

class ControladorCombinadoController extends Controller
{
    public function ejecutarTodo(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1. Registrar la actividad
            $actividad = $this->registrarActividad($request);

            // 2. Registrar alumnos y asociarlos a la actividad
            $this->registrarAlumnos($request, $actividad->id);

            // 3. Asignar 8 tareas aleatorias a cada alumno
            $this->asignarTareas($actividad->id);

            DB::commit();

            return redirect()->back()->with('success', 'Proceso completado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Hubo un problema: ' . $e->getMessage());
        }
    }

    private function registrarActividad(Request $request)
    {
        $alumnos = $request->input('alumnos', []);
        if (empty($alumnos)) {
            throw new \Exception('No hay alumnos cargados para crear una actividad.');
        }

        $primerAlumno = reset($alumnos);
        if (!isset($primerAlumno['Periodo']) || !isset($primerAlumno['Horario'])) {
            throw new \Exception('Faltan datos de Periodo u Horario.');
        }

        return Actividad::create([
            'Periodo' => $primerAlumno['Periodo'],
            'Horario' => $primerAlumno['Horario']
        ]);
    }

    private function registrarAlumnos(Request $request, $actividadId)
    {
        $alumnos = $request->alumnos;
        foreach ($alumnos as $alumnoData) {
            $alumno = Alumno::firstOrCreate(
                ['matricula' => $alumnoData['matricula']],
                ['nombre' => $alumnoData['nombre'], 'password' => bcrypt($this->generarPassword())]
            );

            // Relacionar alumno con la actividad
            ActividadAlumno::firstOrCreate([
                'actividad_id' => $actividadId,
                'alumno_id' => $alumno->id
            ]);
        }
    }

    private function asignarTareas($actividadId)
    {
        $alumnos = Alumno::whereIn('id', function ($query) use ($actividadId) {
            $query->select('alumno_id')->from('actividad_alumno')->where('actividad_id', $actividadId);
        })->get();

        $tareas = Tarea::pluck('id')->toArray();

        if (empty($tareas)) {
            throw new \Exception('No hay tareas disponibles para asignar.');
        }

        foreach ($alumnos as $alumno) {
            // Si hay menos de 8 tareas, se repiten aleatoriamente hasta completar 8
            $tareasAleatorias = collect($tareas)->shuffle()->take(8);
            while ($tareasAleatorias->count() < 8) {
                $tareasAleatorias = $tareasAleatorias->merge(collect($tareas)->shuffle()->take(8 - $tareasAleatorias->count()));
            }

            foreach ($tareasAleatorias as $tareaId) {
                AlumnoTarea::create([
                    'alumno_id' => $alumno->id,
                    'tarea_id' => $tareaId
                ]);
            }
        }
    }


    private function generarPassword($length = 8)
    {
        return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, $length);
    }
}
