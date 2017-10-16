<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposProdanzaToExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expedientes', function(Blueprint $table)
		{
            $table->float('prodanza_monto_solicitado');
            $table->float('prodanza_monto_total');
            $table->string('prodanza_responsable_artistico');
            $table->string('prodanza_nro_orden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
