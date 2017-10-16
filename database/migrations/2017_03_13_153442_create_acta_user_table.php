<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActaUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acta_user', function(Blueprint $table)
		{
			$table->primary(['acta_id', 'user_id']);
            $table->integer('acta_id')->unsigned();
            $table->integer('user_id')->unsigned();
            
            
		});
        
        Schema::table('acta_user', function($table)
        {
            $table->foreign('acta_id')->references('id')->on('actas');
            $table->foreign('user_id')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('acta_user', function(Blueprint $table)
		{
			//
		});
	}

}
