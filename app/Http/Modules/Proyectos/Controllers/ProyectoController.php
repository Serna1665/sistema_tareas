<?php

namespace App\Http\Modules\Proyectos\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Modules\Proyectos\Models\Proyecto;
use App\Http\Modules\Proyectos\Repositories\ProyectoRepository;
use App\Http\Modules\Proyectos\Requests\ActualizarProyectoRequest;
use App\Http\Modules\Proyectos\Requests\CrearProyectoRequest;

class ProyectoController extends Controller
{
    protected $proyectoRepository;

    public function __construct(ProyectoRepository $proyectoRepository)
    {
        $this->proyectoRepository = $proyectoRepository;
    }

    public function listar()
    {
        $proyecto = $this->proyectoRepository->listarConUsuarios();
        return response()->json($proyecto, Response::HTTP_OK);
    }

    public function crear(CrearProyectoRequest $request)
    {
        try {
            $datos = $request->validated();
            $nuevoProyecto = new Proyecto($datos);
            $nuevoProyecto->save();
            return response()->json([
                'mensaje' => 'Se ha registrado correctamente.',
            ], Response::HTTP_CREATED);
        } catch (\Exception $th) {
            return response()->json([
                'mensaje' => 'Error al registrar el proyecto: ', $th->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function actualizar(ActualizarProyectoRequest $request, $id)
    {
        try {
            $proyecto = Proyecto::find($id);
            if (!$proyecto) {
                return response()->json(['mensaje' => 'Proyecto no encontrado'], Response::HTTP_NOT_FOUND);
            }
            $datosActualizados = $request->validated();
            $proyecto->update($datosActualizados);
            return response()->json(['mensaje' => 'Proyecto actualizado correctamente'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al actualizar el proyecto: ' . $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
