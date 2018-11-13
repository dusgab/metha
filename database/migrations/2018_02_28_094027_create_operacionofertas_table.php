<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacionofertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operacionofertas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_contra')->unsigned();
            $table->date('fecha');
            $table->boolean('tipo')->default(true);
            $table->timestamps();

            $table->foreign('id_contra')->references('id')->on('contraofertas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operacionofertas');
    }
}
