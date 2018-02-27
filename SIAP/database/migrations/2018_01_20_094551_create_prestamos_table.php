<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo', function (Blueprint $table) {
            $table->increments('idprestamo');
            $table->date('fecha')->required();
             //formato tipo decimal('nombre de campo',tamaño, precision)
            $table->float('monto')->required();
            $table->float('cuotadiaria')->required();
            $table->date('fechaultimapago')->nullable();
            $table->string('estado',20)->required();
            $table->float('montooriginal')->nullable();
            $table->string('estadodos',20)->nullable();
            $table->integer('cuentaanterior')->nullable();
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
        Schema::drop('prestamo');
    }
}
