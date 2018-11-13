<?php

use Illuminate\Database\Seeder;

class TipoUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('tipo_usuarios')->delete();
        
        \DB::table('tipo_usuarios')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Operador',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Despachante',
            ),
            2 => 
            array (
                'id' => 3,
                'descripcion' => 'Representante',
            ),
        ));
    }
}
