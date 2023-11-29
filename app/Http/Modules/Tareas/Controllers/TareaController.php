<?php

namespace App\Http\Modules\Tareas\Controllers;


use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Modules\Tareas\Models\Tarea;
use App\Http\Modules\Tareas\Repositories\TareasRepository;
use App\Http\Modules\Tareas\Requests\ActualizarTareaRequest;
use App\Http\Modules\Tareas\Requests\CrearTareaRequest;

class TareaController extends Controller
{
    protected $tareaRepository;

    public function __construct(TareasRepository $tareaRepository)
    {
        $this->tareaRepository = $tareaRepository;
    }

    public function listar()
    {
        $tareas = $this->tareaRepository->listarProyecto();
        return response()->json($tareas, Response::HTTP_OK);
    }

    public function crear(CrearTareaRequest $request)
    {
        try {
            $datosTarea = $request->validated();
            $this->tareaRepository->crearTarea($datosTarea);
            return response()->json([
                'message' => 'Tarea creada correctamente',
            ], Response::HTTP_CREATED);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Error al crear la tarea: ', $th->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    public function actualizar(ActualizarTareaRequest $request, $id)
    {
        try {
            $tarea = Tarea::findOrFail($id);
            $tarea->fill($request->validated());
            $tarea->save();

            return response()->json([
                'message' => 'Tarea actualizada correctamente',
            ], Response::HTTP_OK);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Error al actualizar la tarea: ' , $th->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function eliminar($id)
    {
        try {
            $tarea = Tarea::findOrFail($id);
            $tarea->delete();

            return response()->json([
                'message' => 'Tarea eliminada correctamente',
            ], Response::HTTP_OK);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Error al eliminar la tarea: ' ,$th->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
