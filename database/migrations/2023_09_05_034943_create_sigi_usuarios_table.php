<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSigiUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('cod_usuario');
            $table->integer('cod_rol')->unsigned();
            $table->string('nombre', 100);
            $table->string('paterno', 50)->nullable();
            $table->string('materno', 50)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('genero');
            $table->string('ci', 20)->unique()->nullable();
            $table->string('foto', 255)->default('user_default.png');
            $table->string('telefono', 15);
            $table->string('direccion', 255);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->integer('intentos')->default(0);
            $table->dateTime('fecha_intentos')->nullable();
            $table->integer('cod_estado')->default(1);
            $table->timestamps();
            $table->foreign('cod_rol')->references('cod_rol')->on('roles')->onDelete('cascade')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
