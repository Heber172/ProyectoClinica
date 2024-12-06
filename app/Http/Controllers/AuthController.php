<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash as Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use App\Models\Usuario;
use DB;

class AuthController extends Controller
{
    /**
     * Inicio de Sesión de Usuario
     * @param user/password
     * @return \Illuminate\Http\JsonResponse
     * @author Heber Mollericona Miranda
     */
    public function login(Request $request){
        $usuario     = Usuario::where('email', $request->email)->first();
        $credentials = request(['email', 'password']);
        $password    = $request->password;
        $status      = false;
        if(empty($usuario)){
            return response()->json([
                'message' => 'Email incorrecto.',
                'status'  => false
            ], 401);
        }else if($usuario->cod_estado == 2){
            return response()->json([
                'message' => 'Lo sentimos, su cuenta ha sido desactivada. Por favor, póngase en contacto con el administrador para obtener más información.',
                'status'  => false
            ], 401);
        }else{
            if (Hash::check($password, $usuario->password)) {
                $token = auth()->attempt($credentials);
                $usuario->intentos = 0;
                $usuario->fecha_intentos = null;
                $usuario->save();
                return $this->respondWithToken($token);
            } elseif ($usuario->intentos < 5) {
                $usuario->intentos += 1;
                $usuario->save();
                return response()->json([
                        'message' => 'Contraseña incorrecta.',
                        'status'  => $status
                    ], 401);
            } else {
                if (!$usuario->fecha_intentos) {
                    $usuario->fecha_intentos = Carbon::now()->addMinutes(5);
                    $usuario->save();
                    return response()->json([
                            'message' => 'Demasiados intentos, fuiste bloqueado por 5 minutos.',
                            'status'  => $status
                        ], 401);
                } else {
                    if (Carbon::now() <= $usuario->fecha_intentos) {
                        $date = new Carbon($usuario->fecha_intentos);
                        $minutes = Carbon::now()->diffInMinutes($date);
                        if ($minutes > 0) {
                            return response()->json([
                                'message' => 'Demasiados intentos, intente nuevamente en '.$minutes.' minutos.',
                                'status'  => $status
                            ], 401);
                        } else {
                            $seconds = Carbon::now()->diffInSeconds($date);
                            return response()->json([
                                'message' => 'Demasiados intentos, intente nuevamente en '.$seconds.' segundos.',
                                'status' => $status
                            ], 401);
                        }
                    } else {
                        $usuario->intentos = 1;
                        $usuario->fecha_intentos = null;
                        $usuario->save();
                        return response()->json([
                                'message' => 'Contraseña incorrecta.',
                                'status'  => $status
                            ], 401);
                    }
                }
            }
        }
    }
    /**
     * Se obtiene el usuario Autenticado.
     * @return \Illuminate\Http\JsonResponse
     * @author Heber Mollericona Miranda
     */
    public function me(){
        return response()->json(auth()->user());
    }

    /**
     * Cerrar la sesión del usuario (invalidar el token).
     * @return \Illuminate\Http\JsonResponse
     * @author Mollericona Miranda
     */
    public function logout(){
        auth()->logout();
        return response()->json([
            'message' => 'Cerró sesión con éxito',
            'status'  => true
        ]);
    }

    /**
     * Refresh a token.
     * @return \Illuminate\Http\JsonResponse
     * @author Heber Mollericona Miranda
     */
    public function refresh(){
        return $this->respondWithToken(auth()->refresh());
    }
    /**
     * Obtener la estructura de la matriz de tokens.
     * @param  string $token
     * @return \Illuminate\Http\JsonResponse
     * @author Heber Mollericona Miranda
     */
    protected function respondWithToken($token){
        $usuario = auth()->user();

        return response()->json([
            'message'      => 'Éxito! Credenciales válidas.',
            'access_token' => $token,
            'token_type'   => 'bearer',
            'usuario'      => $this->formatUsuarioData($usuario),
            'permisos'     => $usuario->rol->permisos,
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'status'       => true
        ]);
    }

    protected function formatUsuarioData($usuario){
        return [
            'cod_usuario'        => $usuario->cod_usuario,
            'cod_rol'            => $usuario->cod_rol,
            'rol'                => $usuario->rol->descripcion,
            'nombre'             => $usuario->nombre,
            'paterno'            => $usuario->paterno,
            'materno'            => $usuario->materno,
            'fecha_nacimiento'   => $usuario->fecha_nacimiento,
            'genero'             => $usuario->genero,
            'ci'                 => $usuario->ci,
            'foto'               => $usuario->foto,
            'telefono'           => $usuario->telefono,
            'direccion'          => $usuario->direccion,
            'email'              => $usuario->email,
            'log_sucursal'       => $usuario->log_sucursal,
        ];
    }
}