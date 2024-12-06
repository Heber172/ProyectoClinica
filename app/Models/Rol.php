<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    
    protected $table      = 'roles';
    protected $primaryKey = 'cod_rol';
    
    /**
     * Relacion: Obtiene Estado
     */
    public function estado(){
        return $this->belongsTo(Estado::class, 'cod_estado');
    }
    /**
     * Define la relación muchos a muchos entre roles y permisos.
     */
    public function permisos(){
    	return $this->belongsToMany(Permiso::class, 'roles_permisos','cod_rol', 'cod_permiso');
    }
    /**
     * Scope: Buscador general de la lista generada
     */
    public function scopeSearch($query, $term){
        if(!empty($term)){
            $term = "%$term%";
            $query->where(function($query) use($term){
                $query->where('descripcion', 'like', "%$term%")
                    ->orWhereHas('estado', function($query) use($term){
                        $query->where('nombre', 'like', $term);
                    });
            });
        }
    }
}
