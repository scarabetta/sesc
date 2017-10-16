<?php

use Illuminate\Database\Seeder;

use App\TipoVotacion;

class TipoVotacionesTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        ################ VOTACIONES DEFINITIVAS ##############
        
        $params_TipoVotacion1 = [
            'nombre' => 'Prodanza'
        ];
        
        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion1);
        $vot->save();
        
        $params_TipoVotacion1 = [
            'nombre' => 'Mecenazgo'
        ];

        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion1);
        $vot->save();

        ### PROTEATRO ###

        $params_TipoVotacion1 = [
            'nombre' => 'PRT-Grupos'
        ];

        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion1);
        $vot->save();

        $params_TipoVotacion1 = [
            'nombre' => 'Salas'
        ];

        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion1);
        $vot->save();   
        
        $params_TipoVotacion1 = [
            'nombre' => 'Especiales'
        ];

        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion1);
        $vot->save();

        ### BAMUSICA ###

        $params_TipoVotacion1 = [
            'nombre' => 'BAM-Club'
        ];

        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion1);
        $vot->save();

        $params_TipoVotacion1 = [
            'nombre' => 'BAM-Grupo-Solista'
        ];

        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion1);
        $vot->save();

        ### PRODANZA ###

        $params_TipoVotacion1 = [
            'nombre' => 'PRD-Todas'
        ];

        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion1);
        $vot->save();
        
        ################ VOTACIONES DE PRUEBA ################
        
        $params_TipoVotacion1 = [
            'nombre' => 'SiNo'
        ];
        
        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion1);
        $vot->save();
        
        $params_TipoVotacion2 = [
            'nombre' => 'Porcentual'
        ];
        
        $vot = new TipoVotacion();
        $vot->fill($params_TipoVotacion2);
        $vot->save();
        
    }

}
