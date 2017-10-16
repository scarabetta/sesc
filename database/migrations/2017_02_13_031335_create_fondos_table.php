<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFondosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('fondos', function(Blueprint $table){
			$table->increments('id');
			$table->string('nombre');
			$table->string('codigo')->unique();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::drop('fondos');
	}

}
