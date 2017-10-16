<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActaExpedienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acta_expediente', function(Blueprint $table)
		{
			$table->primary(['acta_id', 'expediente_id']);
            $table->integer('acta_id')->unsigned();
            $table->integer('expediente_id')->unsigned();
            $table->string('estado');
		});
        
        Schema::table('acta_expediente', function($table)
        {
            $table->foreign('acta_id')->references('id')->on('actas');
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
		Schema::table('acta_expediente', function(Blueprint $table)
		{
			//
		});
	}

}
