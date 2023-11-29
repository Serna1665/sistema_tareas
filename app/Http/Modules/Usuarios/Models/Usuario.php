<?php

namespace App\Http\Modules\Usuarios\Models;

use App\Http\Modules\Proyectos\Models\Proyecto;
use App\Http\Modules\Tareas\Models\Tarea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'correo',
        'contrasena'
    ];

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
