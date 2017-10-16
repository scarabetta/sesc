<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRespuestaCiudadanoToActaExpedienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acta_expediente', function (Blueprint $table) {
            $table->string('respuesta_ciudadano');
            $table->string('motivo_respuesta_ciudadano');
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
            //
        });
    }
}
