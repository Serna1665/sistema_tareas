<?php

namespace App\Http\Modules\Tareas\Models;

use App\Http\Modules\Proyectos\Models\Proyecto;
use App\Http\Modules\Usuarios\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_finalizacion',
        'estado',
        'proyecto_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
