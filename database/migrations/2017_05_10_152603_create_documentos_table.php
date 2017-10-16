<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('acronimo');
      		$table->mediumText('data'); // base64
			$table->integer('expediente_id')->unsigned();
			$table->timestamps();
		});
        
        Schema::table('documentos', function($table)
        {
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
        Schema::drop('documentos');
    }
}
