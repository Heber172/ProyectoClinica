<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use DB;

class Usuario extends Authenticatable implements JWTSubject
{
    
    protected $table      = 'usuarios';
    protected $primaryKey = 'cod_usuario';

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Relacion: Obtiene Estado
     */
    public function estado(){
        return $this->belongsTo(Estado::class, 'cod_estado');
    }

    /**
     * Relacion: Obtiene Rol
     */
    public function rol(){
        return $this->belongsTo(Rol::class, 'cod_rol');
    }
        
    /**
     * Scope: Buscador general de la lista generada
     */
    public function scopeSearch($query, $term){
        if(!empty($term)){
            $term = "%$term%";
            $query->where(function($query) use($term){
                $query->where(DB::raw("CONCAT(nombre, ' ', paterno, ' ', materno)"), 'like', "%$term%")
                    ->orwhere('ci', 'like', $term)
                    ->orwhere('email', 'like', $term)
                    ->orWhereHas('estado', function($query) use($term){
                        $query->where('nombre', 'like', $term);
                    })
                    ->orWhereHas('rol', function($query) use($term){
                        $query->where('descripcion', 'like', $term);
                    });
            });
        }
    }
}
