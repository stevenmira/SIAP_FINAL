<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('idcliente');

            //CAMPO PARA RELACIONAR negocio CON cartera
            $table->integer('idcartera')->unsigned();
            $table->index('idcartera');
            $table->foreign('idcartera')->references('idcartera')->on('cartera')->onDelete('cascade');            

            $table->string('codigo',10)->required();
            $table->string('nombre',50)->required();
            $table->string('apellido',50)->required();
            $table->string('dui',10)->required();
            $table->string('nit',17)->required();
            $table->integer('edad')->required();
            $table->string('direccion',255)->required();
            $table->string('telefonocel',9);
            $table->string('telefonofijo',9);
            $table->string('profesion',50)->nullable();

            $table->string('lugarexpedicion',50)->required();
            $table->date('fechaexpedicion')->required();

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
        Schema::drop('cliente');
    }
}
