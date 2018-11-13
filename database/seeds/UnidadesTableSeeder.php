<?php

use Illuminate\Database\Seeder;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('medidas')->delete();
        
        \DB::table('medidas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Kilos',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Gramos',
            ),
        ));
    }
}
