<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        TipoUsuariosTableSeeder::class,
        UsersTableSeeder::class,
        RepresentantesTableSeeder::class,
        // CategoriasTableSeeder::class,
        // UnidadesTableSeeder::class,
        // CobrosTableSeeder::class,
        // ModosTableSeeder::class,
        // PuestosTableSeeder::class,
        // ProductosTableSeeder::class,
        // OfertasTableSeeder::class,
        // ContraofertasTableSeeder::class,
        // OperacionofertasTableSeeder::class,
    	]);
    }
}
