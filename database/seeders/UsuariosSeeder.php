<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'cod_rol'       => 1,
            'nombre'        => 'Ronald',
            'paterno'       => 'Mollericona',
            'materno'       => 'Miranda',
            'fecha_nacimiento' => '1999-01-29',
            'genero'        => '1',
            'ci'            => '13408746',
            'telefono'      => '78549821',
            'direccion'     => 'Zona Pedro Domingo Murillo Calle Gregorio García Lanza',
            'email'         => 'roalmollericona@gmail.com',
            'password'      => bcrypt(12345678),
        ]);
    }
}
