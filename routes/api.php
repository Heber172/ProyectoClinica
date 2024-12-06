<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;

// Ruta: Iniciar Sesión
Route::group(['prefix' => 'auth', 'middleware' => 'cors'], function(){
    Route::post('login', [AuthController::class, 'login']);
});

// Rutas: 
Route::group(['middleware' => ['jwt.auth']], function(){
    // * Configuración
    Route::get('configuracion', [ConfiguracionController::class, 'obtieneConfiguracion']);
    Route::put('configuracion/actualizar', [ConfiguracionController::class, 'actualizaConfiguracion']);

    // * Verificación de Sesión
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);

    // * Usuarios
    Route::get('usuario/lista', [UsuarioController::class, 'listaUsuario']);
    Route::get('usuario/crear', [UsuarioController::class, 'crearUsuario']);
    Route::post('usuario/guardar', [UsuarioController::class, 'guardarUsuario']);
    Route::put('usuario/estado/{id}', [UsuarioController::class, 'estadoUsuario']);
    Route::get('usuario/editar/{id}', [UsuarioController::class, 'editarUsuario']);
    Route::put('usuario/actualizar/{id}', [UsuarioController::class, 'actualizarUsuario']);
    Route::post('usuario/quitar-imagen/{id}', [UsuarioController::class, 'quitarImagenUsuario']);
    
    // * Perfil
    Route::get('perfil/editar', [UsuarioController::class, 'editarPerfil']);
    Route::put('perfil/actualizar', [UsuarioController::class, 'actualizarPerfil']);
    
    // * Roles
    Route::get('rol/lista', [RolController::class, 'listaRol']);
    Route::get('rol/crear', [RolController::class, 'crearRol']);
    Route::post('rol/guardar', [RolController::class, 'guardarRol']);
    Route::put('rol/estado/{id}', [RolController::class, 'estadoRol']);
    Route::get('rol/editar/{id}', [RolController::class, 'editarRol']);
    Route::put('rol/actualizar/{id}', [RolController::class, 'actualizarRol']);
    
});