<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('expediente_id')->unsigned();
			$table->text('comentario');
			$table->timestamps();
		});

		Schema::table('votos', function($table)
        {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('expediente_id')->references('id')->on('expedientes');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('votos');
	}

}
