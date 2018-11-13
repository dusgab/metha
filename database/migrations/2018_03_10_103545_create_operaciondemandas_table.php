<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperaciondemandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciondemandas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_contra')->unsigned();
            $table->date('fecha');
            $table->boolean('tipo')->default(false);
            $table->timestamps();

            $table->foreign('id_contra')->references('id')->on('contrademandas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operaciondemandas');
    }
}
