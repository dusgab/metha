<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_op')->unsigned();
            $table->integer('id_prod')->unsigned();
            $table->integer('id_modo')->unsigned();
            $table->integer('peso');
            $table->integer('id_medida')->unsigned();
            $table->integer('cantidad');
            $table->integer('cantidadOriginal');
            $table->double('precio');
            $table->date('fechaEntrega');
            $table->integer('id_puesto')->unsigned();
            $table->integer('id_cobro')->unsigned();
            $table->enum('plazo', ['Contado', '30', '60', '90','Más de 90'])->default('Contado');
            $table->boolean('abierta')->default(false);
            $table->timestamps();

            $table->foreign('id_op')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_prod')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('id_puesto')->references('id')->on('puestos')->onDelete('cascade');
            $table->foreign('id_cobro')->references('id')->on('cobros')->onDelete('cascade');
            $table->foreign('id_modo')->references('id')->on('modos')->onDelete('cascade');
            $table->foreign('id_medida')->references('id')->on('medidas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
}
