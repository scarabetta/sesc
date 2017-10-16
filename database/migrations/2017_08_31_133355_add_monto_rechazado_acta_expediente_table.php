<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMontoRechazadoActaExpedienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acta_expediente', function (Blueprint $table) {
            $table->float('monto_rechazado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acta_expediente', function (Blueprint $table) {
            $table->dropColumn('monto_rechazado');
        });
    }
}
