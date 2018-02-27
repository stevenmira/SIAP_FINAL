<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_liquidacion', function (Blueprint $table) {
            $table->increments('iddetalleliquidacion');
            //CAMPO PARA RELACIONAR DETALLE_LIQUIDACION CON USUARIO
            $table->integer('idusuario')->unsigned();
            $table->index('idusuario');
            $table->foreign('idusuario')->references('idusuario')->on('users')->onDelete('cascade')->nullable();
           //CAMPO PARA RELACIONAR DETALLE_LIQUIDACION CON CUENTA
            $table->integer('idcuenta')->unsigned();
            $table->index('idcuenta');
            $table->foreign('idcuenta')->references('idcuenta')->on('cuenta')->onDelete('cascade');
            
           
           
         
           
            $table->date('fechadiaria')->nullable();
            $table->date('fechaefectiva')->nullable();
            $table->float('monto')->nullable();
            $table->float('interes')->nullable();

            $table->decimal('cuotacapital',6, 2)->nullable();
            $table->decimal('totaldiario',6, 2)->nullable();
            $table->string('abonocapital',10)->nullable();

            $table->string('estado',10)->nullable();
            $table->integer('contador')->nullable();
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
        Schema::drop('detalle_liquidacion');
    }
}
