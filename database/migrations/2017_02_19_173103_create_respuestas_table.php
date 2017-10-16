<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('respuestas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('voto_id')->unsigned();
			$table->integer('opcion_id')->unsigned();
			$table->string('respuesta');
			$table->timestamps();
		});

		Schema::table('respuestas', function($table)
        {
            $table->foreign('voto_id')->references('id')->on('votos');
            $table->foreign('opcion_id')->references('id')->on('votacion_opciones');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('respuestas');
	}

}
