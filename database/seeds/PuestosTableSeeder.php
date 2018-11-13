<?php

use Illuminate\Database\Seeder;

class PuestosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('puestos')->delete();
        
        \DB::table('puestos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Buenos Aires',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Salta',
            ),
            2 => 
            array (
                'id' => 3,
                'descripcion' => 'Rosario',
            ),
            3 => 
            array (
                'id' => 4,
                'descripcion' => 'Corrientes',
            ),
        ));
    }
}
