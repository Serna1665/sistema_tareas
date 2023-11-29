<?php

use App\Http\Modules\Proyectos\Controllers\ProyectoController;
use App\Http\Modules\Tareas\Controllers\TareaController;
use App\Http\Modules\Usuarios\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('usuarios')->group(function () {
    Route::controller(UsuarioController::class)->group(function () {
        Route::get('listar', 'listar');
        Route::post('crear', 'crear');
    });
});

Route::prefix('proyectos')->group(function () {
    Route::controller(ProyectoController::class)->group(function () {
        Route::get('listar', 'listar');
        Route::post('crear', 'crear');
    });
});

Route::prefix('tareas')->group(function () {
    Route::controller(TareaController::class)->group(function () {
        Route::get('listar', 'listar');
        Route::post('crear', 'crear');
        Route::put('actualizar/{id}', 'actualizar');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
