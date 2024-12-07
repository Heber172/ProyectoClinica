<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\UsuarioTipo;
use App\Models\Sucursal;
use App\Models\Especialidad;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Obtiene la lista de datos
     * Tipo: GET
     * URL: api/usuario/lista
     * @autor: Heber Mollericona
     */
    public function listaUsuario(Request $request){
        $paginate       = $request->input('paginate', 10);            // Paginación
        $search         = $request->input('q', '');                   // Busqueda
        $sort_field     = $request->input('sort_field', 'desc');      // Orden (CAMPO)
        if(!in_array($sort_field, ['cod_usuario', 'cod_rol', 'cod_usuario_tipo', 'nombre', 'ci', 'email', 'cod_estado'])){
            $sort_field = 'created_at';
        }
        $sort_direction = $request->input('sort_direction', 'desc');  // Orden (ASC, DESC)
        if(!in_array($sort_direction, ['asc', 'desc'])){
            $sort_direction = 'desc';
        }

        $usuarios = Usuario::with(['estado', 'rol'])
                            ->search(trim($search))
                            ->orderBy($sort_field, $sort_direction)
                            ->paginate($paginate);

        return response()->json([
            'usuarios' => $usuarios
        ]);
    }
    /**
     * Obtiene datos generales para nuevo registro
     * Tipo: GET
     * URL: api/usuario/crear
     * @autor: Heber Mollericona
     */
    public function crearUsuario(){
        $roles    = Rol::where('cod_estado',1)->get();

        return response()->json([
            'roles'     => $roles,
        ]);
    }
    /**
     * Almacena todos los datos.
     * Tipo: POST
     * URL: api/usuario/guardar
     * @autor: Heber Mollericona
     */
    public function guardarUsuario(Request $request){
        $usuario = new Usuario;
        $usuario->nombre     = $request->nombre;
        $usuario->paterno    = $request->paterno;
        $usuario->materno    = $request->materno;
        $usuario->ci         = $request->ci;
        $usuario->cod_rol    = $request->cod_rol;
        $usuario->cod_usuario_tipo = $request->cod_usuario_tipo;
        $usuario->password   = bcrypt($request->ci);
        $usuario->email      = $request->email;
        $usuario->telefono   = $request->telefono;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->genero     = $request->genero;
        $usuario->codigo     = $request->codigo;
        $usuario->direccion  = $request->direccion;
        $usuario->color      = $request->color;
        if($request->hasfile('foto')){
            $file            = $request->file('foto');
            $name            = time()."_".$file->getClientOriginalName();
            $usuario->foto   = $name;
            $file->move(public_path().'/imagenes/usuarios/',$name);
        }
        $usuario->save();

        return response()->json([
            'message' =>'Registro creado exitosamente',
            'status'  => true
        ], 200);
    }
    /**
     * Obtiene datos del registro para editar
     * Tipo: GET
     * URL: api/usuario/editar
     * @autor: Heber Mollericona
     */
    public function editarUsuario($id){
        $usuario  = Usuario::with(['rol'])->findOrFail($id);
        $roles    = Rol::where('cod_estado',1)->get();

        return response()->json([
            'usuario'   => $usuario,
            'roles'     => $roles,
        ]);
    }
    /**
     * Actualiza todos los datos del registro indicado en $id.
     * Tipo: POST
     * URL: api/usuario/actualizar/{id}
     * @autor: Heber Mollericona
     */
    public function actualizarUsuario(Request $request, $id){
        $usuario             = Usuario::FindOrFail($id);
        $usuario->nombre     = $request->nombre;
        $usuario->paterno    = $request->paterno;
        $usuario->materno    = $request->materno;
        $usuario->ci         = $request->ci;
        $usuario->cod_rol    = $request->cod_rol;
        $usuario->cod_usuario_tipo = $request->cod_usuario_tipo;
        $usuario->email            = $request->email;
        $usuario->telefono         = $request->telefono;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->genero     = $request->genero;
        $usuario->codigo     = $request->codigo;
        $usuario->direccion  = $request->direccion;
        $usuario->color      = $request->color;
        if($request->hasfile('foto')){
            if($usuario->foto != "default.png"){
                $image_path 	= public_path().'/imagenes/usuarios/'.$usuario->foto;
                \File::delete($image_path);
            }
            $file 			= $request->file('foto');
            $name   		= time()."_".$file->getClientOriginalName();
            $usuario->foto 	= $name;
            $file->move(public_path().'/imagenes/usuarios/',$name);
        }
        $usuario->update();

        return response()->json([
            'message' =>'Registro actualizado exitosamente',
            'status'  => true
        ], 200);
    }
    /**
     * Quitar Imagen cargada
     * Tipo: POST
     * URL: api/usuario/quitar-imagen/{id}
     * @autor: Heber Mollericona
     */
    public function quitarImagenUsuario(Request $request, $id){
        $usuario             = Usuario::FindOrFail($id);

        $image_path 	= public_path().'/imagenes/usuarios/'.$usuario->foto;
        \File::delete($image_path);

        $usuario->foto 	= "default.png";
        $usuario->update();

        return response()->json([
            'message' =>'Se ha quitado la foto exitosamente',
            'status'  => true
        ], 200);
    }
    /**
     * Modifica Estado.
     * Tipo: PUT
     * URL: api/usuario/estado/{id}
     * @autor: Heber Mollericona
     */
    public function estadoUsuario($id){
        $usuario = Usuario::findOrfail($id);
        $usuario->cod_estado = $usuario->cod_estado == 1 ? 2 : 1;
        $usuario->update();
        return response()->json([
            'message' =>'Registro actualizado exitosamente',
            'status'  => true
        ], 200);
    }
    /**
     * Modifica el log_sucursal  del registro indicado en $id.
     * Tipo: PUT
     * URL: api/usuario/cambia-sucursal/{id}
     * @autor: Heber Mollericona
     */
    public function cambiaSucursal(Request $request, $id){
        $usuario               = Usuario::FindOrFail($id);
        $usuario->log_sucursal = $request->cod_sucursal;
        $usuario->update();

        return response()->json([
            'message' =>'¡Se ha cambiado de sucursal exitosamente!',
            'status'  => true
        ], 200);
    }
    /*************************************************************/
    /**
     * Obtiene datos del PERFIL seleccionado
     * Tipo: GET
     * URL: api/perfil/editar
     * @autor: Heber Mollericona
     */
    public function editarPerfil(Request $request){
        $cod_usuario  = auth()->user()->cod_usuario;
		$perfil       = Usuario::select('nombre', 'paterno', 'materno', 'foto', 'color')->findOrFail($cod_usuario);
        $perfil->foto = "/imagenes/usuarios/" . $perfil->foto;

        return response()->json([
            'perfil' => $perfil,
        ]);
    }
    /**
     * Actualiza todos los datos del PERFIL
     * Tipo: PUT
     * URL: api/perfil/actualizar
     * @autor: Heber Mollericona
     */
    public function actualizarPerfil(Request $request){
        $cod_usuario = auth()->user()->cod_usuario;
        $perfil             = Usuario::FindOrFail($cod_usuario);
        // Validar la contraseña actual
        if (!Hash::check($request->pass_actual, $perfil->password) && !empty($request->pass_confirmar)) {
            return response()->json([
                'message' =>'La contraseña actual no es válida',
                'status'  => false
            ], 400);
        }

        $perfil->nombre  = $request->nombre;
        $perfil->paterno = $request->paterno;
        $perfil->materno = $request->materno;
        $perfil->color   = $request->color;
        if($request->hasfile('foto')){
            if($perfil->foto != "default.png"){
                $image_path 	= public_path().'/imagenes/usuarios/'.$perfil->foto;
                \File::delete($image_path);
            }
            $file 			= $request->file('foto');
            $name   		= time()."_".$file->getClientOriginalName();
            $perfil->foto 	= $name;
            $file->move(public_path().'/imagenes/usuarios/',$name);
        }
        // Contraseña
        if(!empty($request->pass_confirmar)){
            $perfil->password = bcrypt($request->pass_confirmar);
        }
        $perfil->update();
        return response()->json([
            'message' =>'Registro actualizado exitosamente',
            'status'  => true
        ], 200);
    }
}
