<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotacionOpcionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votacion_opciones', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('tipo_votacion_id')->unsigned();
            $table->string('pregunta');
            $table->string('tipo_rta');
			$table->timestamps();
		});

        Schema::table('votacion_opciones', function($table)
        {
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
		Schema::drop('votacion_opciones');
	}

}
