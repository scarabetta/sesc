<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('presupuestos', function(Blueprint $table)
		{
			//$table->increments('id');
            $table->integer('linea_id')->unsigned();
            $table->integer('year')->unsigned();
            $table->double('monto',15,2);
            $table->timestamps();
            $table->primary(['linea_id', 'year']);
		});
        
        Schema::table('presupuestos', function($table)
        {
            $table->foreign('linea_id')->references('id')->on('lineas');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('presupuestos');
	}

}
