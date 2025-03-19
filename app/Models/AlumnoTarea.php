<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoTarea extends Model {
    use HasFactory;

    protected $table = 'alumno_tarea';
    protected $fillable = ['matricula', 'tarea_id'];

    public function alumno() {
        return $this->belongsTo(Alumno::class, 'matricula', 'matricula');
    }

    public function tarea() {
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }
}

