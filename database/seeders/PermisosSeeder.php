<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permisos')->insert([
            [
                'descripcion' => 'Listar usuarios',
                'modulo' => 'Gestión de usuarios',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descripcion' => 'Crear usuarios',
                'modulo' => 'Gestión de usuarios',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descripcion' => 'Editar usuarios',
                'modulo' => 'Gestión de usuarios',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descripcion' => 'Deshabilitar usuarios',
                'modulo' => 'Gestión de usuarios',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descripcion' => 'Listar roles',
                'modulo' => 'Gestión de usuarios',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descripcion' => 'Crear roles',
                'modulo' => 'Gestión de usuarios',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descripcion' => 'Editar roles',
                'modulo' => 'Gestión de usuarios',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descripcion' => 'Deshabilitar roles',
                'modulo' => 'Gestión de usuarios',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);        
    }
}
