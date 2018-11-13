<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCiudadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('id_provincia')->unsigned();
            $table->string('nombre');
            $table->string('codigopostal');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('id_provincia')->references('id')->on('provincias')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciudades');
    }
}
