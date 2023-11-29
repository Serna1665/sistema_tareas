<?php

namespace App\Http\Modules\Usuarios\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Modules\Usuarios\Models\Usuario;
use App\Http\Modules\Usuarios\Requests\CrearUsuarioRequest;

class UsuarioController extends Controller
{
    public function listar()
    {
        try {
            $usuarios = Usuario::all();

            return response()->json(['usuarios' => $usuarios], 200);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Error al obtener la lista de usuarios: ', $th->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function crear(CrearUsuarioRequest $request)
    {
        try {
            Usuario::create($request->validated());
            return response()->json([
                'message' => 'Se ha registrado correctamente.',
            ], Response::HTTP_CREATED);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Error al registrar el usuario: ', $th->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
