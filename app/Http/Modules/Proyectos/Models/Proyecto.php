<?php

namespace App\Http\Modules\Proyectos\Models;

use App\Http\Modules\Tareas\Models\Tarea;
use App\Http\Modules\Usuarios\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_finalizacion',
        'tarea_id'
    ];

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class);
    }
}
