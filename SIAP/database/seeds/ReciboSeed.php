<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class ReciboSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recibo')->insert([
            'numerico' => 1,
            'estado' => 'ACTIVO',
            
        ]);
    }
}
