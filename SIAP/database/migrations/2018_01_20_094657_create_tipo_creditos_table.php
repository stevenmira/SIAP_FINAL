<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_credito', function (Blueprint $table) {
            $table->increments('idtipocredito');
            $table->string('nombre')->required();
            //formato tipo decimal('nombre de campo',tamaño, precision)
            $table->float('monto');
            $table->float('interes')->required();
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
        Schema::drop('tipo_credito');
    }
}
