<?php

use Illuminate\Database\Seeder;

class CobrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cobros')->delete();
        
        \DB::table('cobros')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Efectivo',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Cheque',
            ),
            2 => 
            array (
                'id' => 3,
                'descripcion' => 'Comisión',
            ),
        ));
    }
}
