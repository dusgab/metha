<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('productos')->delete();
        
        \DB::table('productos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Papa',
                'descripcion' => 'Blanca',
                'descripcion2' => 'Grande',
                'id_cat' => '2',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Cebolla',
                'descripcion' => 'Morada',
                'descripcion2' => 'Chica',
                'id_cat' => '1',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Pomelo',
                'descripcion' => 'Rosado',
                'descripcion2' => 'Grande',
                'id_cat' => '3',
            ),
        ));
    }
}
