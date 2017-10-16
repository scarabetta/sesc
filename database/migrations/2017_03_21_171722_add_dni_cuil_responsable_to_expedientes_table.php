<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDniCuilResponsableToExpedientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('expedientes', function(Blueprint $table)
		{
			$table->string('responsable_dni');
            $table->string('responsable_cuil');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('expedientes', function(Blueprint $table)
		{
            
		});
	}

}
