<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolFondoToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::table('users', function(Blueprint $table){
			$table->integer('rol_id')->references('id')->on('roles')->onDelete('cascade');
			$table->integer('fondo_id')->nullable()->references('id')->on('fondos')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			//
		});
	}

}
