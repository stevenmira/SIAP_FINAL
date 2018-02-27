<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class Tipo_Credito extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_credito')->insert([
            'nombre' => 'normal menor a $80',
            'monto' => 0,
            'interes' => 0.017,
        ]);

        DB::table('tipo_credito')->insert([
            'nombre' => 'normal entre $80 y $105',
            'monto' => 0,
            'interes' => 0.011,
        ]);

        DB::table('tipo_credito')->insert([
            'nombre' => 'normal mayor a $105',
            'monto' => 0,
            'interes' => 0.010,
        ]);

        DB::table('tipo_credito')->insert([
            'nombre' => 'preferencial',
            'monto' => 0,
            'interes' => 0.008,
        ]);

        DB::table('tipo_credito')->insert([
            'nombre' => 'oro',
            'monto' => 0,
            'interes' => 0.007,
        ]);
    }
}
