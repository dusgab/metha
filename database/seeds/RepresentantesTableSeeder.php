<?php

use Illuminate\Database\Seeder;

class RepresentantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('representantes')->delete();
        
        \DB::table('representantes')->insert(array (
            0 => 
            array (
                'id_user' => '2',
            )
        ));
    }
}
