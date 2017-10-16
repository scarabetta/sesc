<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nro_gedo')->unique()->nullable();
            $table->string('estado');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('acta_expediente');
        Schema::drop('acta_user');
		Schema::drop('actas');
	}

}
