<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta', function (Blueprint $table) {
            $table->increments('idcuenta');
            //CAMPO PARA RELACIONAR cuenta CON tipo_credito
            $table->integer('idtipocredito')->unsigned();
            $table->index('idtipocredito');
            $table->foreign('idtipocredito')->references('idtipocredito')->on('tipo_credito')->onDelete('cascade');
            //CAMPO PARA RELACIONAR cuenta CON prestamo
            $table->integer('idprestamo')->unsigned();
            $table->index('idprestamo');
            $table->foreign('idprestamo')->references('idprestamo')->on('prestamo')->onDelete('cascade');
            //CAMPO PARA RELACIONAR cuenta CON negocio
            $table->integer('idnegocio')->unsigned();
            $table->index('idnegocio');
            $table->foreign('idnegocio')->references('idnegocio')->on('negocio')->onDelete('cascade');
                        
            //formato tipo decimal('nombre de campo',tamaño, precision)
            $table->float('montocapital');
            $table->float('interes');
            $table->date('fechaultimapago')->nullable();
            $table->float('capitalanterior')->nullable();
            $table->float('mora')->nullable();
            $table->integer('cuotaatrasada')->nullable();
            $table->integer('numeroprestamo')->nullable();
            
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
        Schema::drop('cuenta');
    }
}
