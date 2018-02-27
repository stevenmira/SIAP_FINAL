<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class Tipo_Usuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuario')->insert([
            'nombre' => 'Administrador',
        ]);

        DB::table('tipo_usuario')->insert([
            'nombre' => 'Estandar',
        ]);
    }
}
