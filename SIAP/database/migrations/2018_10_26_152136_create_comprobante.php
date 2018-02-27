<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprobante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobante', function (Blueprint $table){
            $table->increments('idcomprobante');

            //CAMPO PARA RELACIONAR comprobante CON cuenta
            $table->integer('idcuenta')->unsigned();
            $table->index('idcuenta');
            $table->foreign('idcuenta')->references('idcuenta')->on('cuenta')->onDelete('cascade');
            $table->float('gastosadmon')->required();
            $table->float('gastosnotariales')->required();
            $table->decimal('mora')->required();
            $table->integer('diasatrasados');
            $table->float('totalcuotas');
            $table->integer('diaspendientes');
            $table->float('totalpendiente');
            $table->integer('cuotadeuda');
            $table->float('totalcuotasdeuda');
            $table->float('ultimacuota');
            $table->float('montoactual')->required();
            $table->float('total')->required();
            $table->date('fechacomprobante')->required();
            $table->string('estado',20)->required();
            $table->string('estadodos',20)->required();
            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::drop('comprobante');
    }
}
