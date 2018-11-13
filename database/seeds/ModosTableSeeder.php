<?php

use Illuminate\Database\Seeder;

class ModosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('modos')->delete();
        
        \DB::table('modos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Raso',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Abierto',
            ),
            2 => 
            array (
                'id' => 3,
                'descripcion' => 'Paquete',
            ),
            3 => 
            array (
                'id' => 4,
                'descripcion' => 'Caja',
            ),
            4 => 
            array (
                'id' => 5,
                'descripcion' => 'Bolsa',
            ),
            5 => 
            array (
                'id' => 6,
                'descripcion' => 'Mazo',
            ),
        ));
    }
}
