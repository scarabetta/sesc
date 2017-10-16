<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGrupoBamusicaExpedientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('expedientes', function(Blueprint $table)
        {
            $table->string('bamusica_nombre_grupo');
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
			//
		});
	}

}
