<?php

namespace App\Http\Modules\Tareas\Repositories;

use App\Http\Modules\Tareas\Models\Tarea;

class TareasRepository
{

    public function listarProyecto()
    {
        return Tarea::select(
            'tareas.id',
            'tareas.nombre',
            'tareas.descripcion',
            'tareas.fecha_inicio',
            'tareas.fecha_finalizacion',
            'tareas.estado',
            'usuarios.nombre as nombre_usuario',
            'proyectos.nombre as nombre_proyecto',
        )
            ->leftjoin('usuarios', 'tareas.usuario_id', 'usuarios.id')
            ->join('proyectos', 'tareas.proyecto_id' , 'proyectos.id')
            ->get();
    }

    public function crearTarea($datos)
    {
        return Tarea::create($datos);
    }
}
