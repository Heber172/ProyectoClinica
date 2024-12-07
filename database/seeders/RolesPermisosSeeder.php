<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // El código de rol que deseas asignar a todos los registros.
        $codRol = 1;
        // Inicializar un array para almacenar los datos
        $data = [];
        // Crear el array de datos con cod_permiso de 1 a 8
        for ($codPermiso = 1; $codPermiso <= 8; $codPermiso++) {
            $data[] = [
                'cod_rol'     => 1,
                'cod_permiso' => $codPermiso,
            ];
        }
        // Insertar todos los registros en la tabla roles_permisos
        DB::table('roles_permisos')->insert($data);
    }
}
