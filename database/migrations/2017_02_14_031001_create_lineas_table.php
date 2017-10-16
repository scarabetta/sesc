<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lineas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre');
			$table->timestamps();
            $table->integer('fondo_id')->unsigned();
            $table->integer('tipo_votacion_id')->unsigned();
		});
    
        Schema::table('lineas', function($table)
        {
            $table->foreign('fondo_id')->references('id')->on('fondos');
            $table->foreign('tipo_votacion_id')->references('id')->on('tipo_votaciones');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lineas');
	}

}
