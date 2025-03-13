<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlumnoController extends Controller
{
    /**
     * Registra múltiples alumnos en la base de datos y genera contraseñas aleatorias.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registrar(Request $request)
    {
        $request->validate([
            'alumnos' => 'required|array',
            'alumnos.*.matricula' => 'required|string',
            'alumnos.*.nombre' => 'required|string',
        ]);

        $alumnosRegistrados = [];
        $alumnos = $request->alumnos;

        foreach ($alumnos as $alumnoData) {
            // Verificar si el alumno ya existe
            $alumnoExistente = Alumno::where('matricula', $alumnoData['matricula'])->first();
            
            if ($alumnoExistente) {
                // Si ya existe, simplemente agregarlo al array de resultados con su contraseña actual
                $alumnosRegistrados[] = [
                    'matricula' => $alumnoExistente->matricula,
                    'nombre' => $alumnoExistente->nombre,
                    'password' => 'Ya registrado anteriormente'
                ];
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
            
            // Agregar a la lista de resultados
            $alumnosRegistrados[] = [
                'matricula' => $alumno->matricula,
                'nombre' => $alumno->nombre,
                'password' => $password // Guardamos la contraseña sin encriptar para mostrarla
            ];
        }
        
        // Redirigir con mensaje de éxito y los datos registrados
        return redirect()->back()
            ->with('success', 'Se han creado ' . count($alumnosRegistrados) . ' cuentas de alumnos correctamente.')
            ->with('alumnos_registrados', $alumnosRegistrados);
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