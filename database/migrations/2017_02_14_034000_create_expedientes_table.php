<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expedientes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('numero')->unique();
            $table->string('proyecto_nombre');
            $table->string('responsable_nombre');
            $table->text('responsable_desc');
            $table->text('observaciones');
            $table->date('fecha_presentacion');
            $table->float('monto_solicitado');
            $table->float('monto_otorgado');
            $table->string('estado');      
            $table->timestamps();
            $table->integer('linea_id')->unsigned();
      
		});
    
    Schema::table('expedientes', function($table)
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
		Schema::drop('expedientes');
	}

}
