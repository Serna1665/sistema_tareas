<?php

namespace App\Http\Modules\Proyectos\Repositories;

use App\Http\Modules\Proyectos\Models\Proyecto;
use App\Http\Modules\Usuarios\Models\Usuario;

class ProyectoRepository
{
    public function listarConUsuarios()
    {
        return Proyecto::select(
            'proyectos.id',
            'proyectos.nombre',
            'proyectos.descripcion',
            'proyectos.fecha_inicio',
            'proyectos.fecha_finalizacion',
            'usuarios.nombre as nombre_usuario'
        )
        ->leftjoin('usuarios', 'proyectos.usuario_id', 'usuarios.id')
        ->get();
    }
}
