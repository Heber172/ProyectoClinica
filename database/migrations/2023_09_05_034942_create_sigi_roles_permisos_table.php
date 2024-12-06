<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSigiRolesPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permisos', function (Blueprint $table) {
            $table->integer('cod_rol')->unsigned();
            $table->integer('cod_permiso')->unsigned();
            $table->foreign('cod_rol')->references('cod_rol')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cod_permiso')->references('cod_permiso')->on('permisos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_permisos');
    }
}
