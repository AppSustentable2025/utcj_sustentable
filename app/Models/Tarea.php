<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas'; // Asegúrate de que el nombre de la tabla sea el correcto.
    
    protected $fillable = ['nombre', 'descripcion', 'integrantes']; // Los campos que se pueden llenar masivamente.

    public $timestamps = true; // Para que se gestionen los timestamps automáticamente.
}
