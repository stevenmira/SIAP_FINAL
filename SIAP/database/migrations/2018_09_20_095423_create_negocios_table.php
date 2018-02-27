<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocio', function (Blueprint $table) {
            $table->increments('idnegocio');

            //CAMPO PARA RELACIONAR negocio CON cliente
            $table->integer('idcliente')->unsigned();
            $table->index('idcliente');
            $table->foreign('idcliente')->references('idcliente')->on('cliente')->onDelete('cascade');

            $table->string('nombre',50)->required();
            $table->string('actividadeconomica',255)->required();
            $table->string('direccionnegocio',255)->required();
            $table->string('estado',10);
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
        Schema::drop('negocio');
    }
}
