<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('idusuario');
             //CAMPO PARA RELACIONAR usuario CON tipousuario
            $table->integer('idtipousuario')->unsigned();
            $table->index('idtipousuario');
            $table->foreign('idtipousuario')->references('idtipousuario')->on('tipo_usuario')->onDelete('cascade');
            $table->string('nombre')->unique()->required();
            $table->string('name')->unique()->required();
            $table->string('email')->unique()->required();
            $table->string('password')->required();
            $table->rememberToken();
            $table->timestamps();

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');

    }
}
