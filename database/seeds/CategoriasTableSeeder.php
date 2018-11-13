<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('categorias')->delete();
        
        \DB::table('categorias')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Hortalizas',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Frutas',
            ),
            2 => 
            array (
                'id' => 3,
                'descripcion' => 'Otros',
            ),
        ));
    }
}
