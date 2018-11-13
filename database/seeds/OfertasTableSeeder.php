<?php

use Illuminate\Database\Seeder;

class OfertasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_op' => 2,
                'id_prod' => 1,
                'id_modo' => 1,
                'peso' => 20,
                'id_medida' => 1,
                'cantidad' => 320,
                'cantidadOriginal' => 320,
                'precio' => 432,
                'fechaEntrega' => '2018-03-24',
                'id_puesto' => 2,
                'id_cobro' => 3,
                'plazo' => '30',
                'abierta' => 0,
                'created_at' => '2017-10-11 12:48:57',
                'updated_at' => '2017-10-11 12:48:57',
            ),
            1 => 
            array (
                'id' => 2,
                'id_op' => 3,
                'id_prod' => 2,
                'id_modo' => 3,
                'peso' => 25,
                'id_medida' => 1,
                'cantidad' => 300,
                'cantidadOriginal' => 300,
                'precio' => 400,
                'fechaEntrega' => '2018-03-25',
                'id_puesto' => 2,
                'id_cobro' => 3,
                'plazo' => '60',
                'abierta' => 0,
                'created_at' => '2017-10-11 12:48:57',
                'updated_at' => '2017-10-11 12:48:57',
            ),
            2 => 
            array (
                'id' => 3,
                'id_op' => 4,
                'id_prod' => 3,
                'id_modo' => 2,
                'peso' => 15,
                'id_medida' => 1,
                'cantidad' => 200,
                'cantidadOriginal' => 200,
                'precio' => 220,
                'fechaEntrega' => '2018-03-26',
                'id_puesto' => 2,
                'id_cobro' => 1,
                'plazo' => '90',
                'abierta' => 0,
                'created_at' => '2017-10-11 12:48:57',
                'updated_at' => '2017-10-11 12:48:57',
            ),
        ));
    }
}
