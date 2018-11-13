<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'name' => 'Administrador',
                'apellido' => 'Administrador',
                'razonsocial' => 'Administrador',
                'email' => 'dustingassmann@gmail.com',
                'password' => bcrypt('coop2018'),
                'cuit' => 0,
                'telefono' => 0,
                'domicilio' => 'san martin',
                'id_provincia' => 5,
                'id_ciudad' => 6372,
                'tipo_us' => 1,
                'registro' => '000000',
                'activo' => 1,
                'admin' => 1,
                'pendientes' => 0,
                'remember_token' => 'cXobM1QOv1L0FDlFkJzgWspHkluC9jWseVN8yIlmg0XETcYfI2JngelqJppR',
                'created_at' => '2017-10-11 12:48:57',
                'updated_at' => '2017-10-11 12:48:57',
            ),
            1 => 
            array (
                'name' => 'Representante',
                'apellido' => 'Nulo',
                'razonsocial' => 'Nulo',
                'email' => 'Nulo@Nulo.com',
                'password' => bcrypt('Nulo'),
                'cuit' => 0,
                'telefono' => 0,
                'domicilio' => 'Nulo',
                'id_provincia' => 5,
                'id_ciudad' => 6372,
                'tipo_us' => 3,
                'registro' => '000000',
                'activo' => 1,
                'admin' => 0,
                'pendientes' => 0,
                'remember_token' => 'cXobM1QOv1L0FDlFkJzgWspHkluC9jWseVN8yIlmg0XETcYfI2JngelqJppR',
                'created_at' => '2017-10-11 12:48:57',
                'updated_at' => '2017-10-11 12:48:57',
            ),
        ));
        
        
    }
}