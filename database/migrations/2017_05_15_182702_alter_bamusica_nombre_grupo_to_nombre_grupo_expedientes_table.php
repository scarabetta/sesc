<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBamusicaNombreGrupoToNombreGrupoExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->renameColumn('bamusica_nombre_grupo', 'nombre_grupo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            //
        });
    }
}
