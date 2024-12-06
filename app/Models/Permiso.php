<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    
    protected $table      = 'permisos';
    protected $primaryKey = 'cod_permiso';

    public function roles(){
    	return $this->belongsToMany(Role::class, 'roles_permisos', 'cod_permiso','cod_rol');
    }
}
