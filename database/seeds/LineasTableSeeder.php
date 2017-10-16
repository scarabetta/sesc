<?php

use Illuminate\Database\Seeder;

use App\Linea;

class LineasTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ########## Lineas de Prodanza ############
        
        $fondo = DB::table('fondos')->where('codigo', 'PRD')->first();
        $tipo = DB::table('tipo_votaciones')->where('nombre', 'PRD-Todas')->first();
        
        $params_linea1 = [
            'nombre' => 'Estables',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea1);
        $linea1->save();
        
        $params_linea1 = [
            'nombre' => 'Puntuales',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea1);
        $linea1->save();
        
        $params_linea1 = [
            'nombre' => 'Salas',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea1);
        $linea1->save();
        
        $params_linea1 = [
            'nombre' => 'Asociaciones',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea1);
        $linea1->save();

        
        ########## Lineas de Proteatro ############
        
        $fondo = DB::table('fondos')->where('codigo', 'PRT')->first();
        $tipo = DB::table('tipo_votaciones')->where('nombre', 'Porcentual')->first();
        $tipo_grupos = DB::table('tipo_votaciones')->where('nombre', 'PRT-Grupos')->first();
        $tipo_salas = DB::table('tipo_votaciones')->where('nombre', 'Salas')->first();
        $tipo_especiales = DB::table('tipo_votaciones')->where('nombre', 'Especiales')->first();
        
        $params_linea2 = [
            'nombre' => 'Grupos Comunitarios',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo_grupos->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Grupos Eventuales',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo_grupos->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Grupos Estables',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo_grupos->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Salas Teatrales',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo_salas->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Proyectos Especiales',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo_especiales->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        ########## Lineas de Mecenazgo ############

        $fondo = DB::table('fondos')->where('codigo', 'MZ')->first();
        $tipo = DB::table('tipo_votaciones')->where('nombre', 'Mecenazgo')->first();

        $params_linea2 = [
            'nombre' => 'Danza',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Diseño',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Artes',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Publicaciones',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Teatro',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Musica',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Patrimonio cultural',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Literatura',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Circo, murga, mímica y afines',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();
        
        $params_linea2 = [
            'nombre' => 'Artesania y arte Popular',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo->id,
        ];

        $linea1 = new Linea();
        $linea1->fill($params_linea2);
        $linea1->save();

        ########## Lineas de BAMUSICA ############
        $fondo = DB::table('fondos')->where('codigo', 'BAM')->first();
        $tipo_clubes = DB::table('tipo_votaciones')->where('nombre', 'BAM-Club')->first();
        $tipo_gs = DB::table('tipo_votaciones')->where('nombre', 'BAM-Grupo-Solista')->first();
        
        $params_linea3 = [
            'nombre' => 'Club de Música',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo_clubes->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea3);
        $linea1->save();
        
        $params_linea3 = [
            'nombre' => 'Grupo de Músicos estable',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo_gs->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea3);
        $linea1->save();
        
        $params_linea3 = [
            'nombre' => 'Músico Solista',
            'fondo_id' => $fondo->id,
            'tipo_votacion_id' => $tipo_gs->id,
        ];
        
        $linea1 = new Linea();
        $linea1->fill($params_linea3);
        $linea1->save();

          

        
        
    }

}
