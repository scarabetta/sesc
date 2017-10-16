<?php

use Illuminate\Database\Seeder;

use App\Expediente;
use App\Documento;

class ExpedientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        $params_doc = [
            'acronimo' => 'IFBOC',
            'data' =>   'JVBERi0xLjEKJcKlwrHDqwoKMSAwIG9iagogIDw8IC9UeXBlIC9DYXRhbG9nCiAgICAgL1BhZ2Vz
                        IDIgMCBSCiAgPj4KZW5kb2JqCgoyIDAgb2JqCiAgPDwgL1R5cGUgL1BhZ2VzCiAgICAgL0tpZHMg
                        WzMgMCBSXQogICAgIC9Db3VudCAxCiAgICAgL01lZGlhQm94IFswIDAgMzAwIDE0NF0KICA+Pgpl
                        bmRvYmoKCjMgMCBvYmoKICA8PCAgL1R5cGUgL1BhZ2UKICAgICAgL1BhcmVudCAyIDAgUgogICAg
                        ICAvUmVzb3VyY2VzCiAgICAgICA8PCAvRm9udAogICAgICAgICAgIDw8IC9GMQogICAgICAgICAg
                        ICAgICA8PCAvVHlwZSAvRm9udAogICAgICAgICAgICAgICAgICAvU3VidHlwZSAvVHlwZTEKICAg
                        ICAgICAgICAgICAgICAgL0Jhc2VGb250IC9UaW1lcy1Sb21hbgogICAgICAgICAgICAgICA+Pgog
                        ICAgICAgICAgID4+CiAgICAgICA+PgogICAgICAvQ29udGVudHMgNCAwIFIKICA+PgplbmRvYmoK
                        CjQgMCBvYmoKICA8PCAvTGVuZ3RoIDU1ID4+CnN0cmVhbQogIEJUCiAgICAvRjEgMTggVGYKICAg
                        IDAgMCBUZAogICAgKEhlbGxvIFdvcmxkKSBUagogIEVUCmVuZHN0cmVhbQplbmRvYmoKCnhyZWYK
                        MCA1CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMDAxOCAwMDAwMCBuIAowMDAwMDAwMDc3IDAw
                        MDAwIG4gCjAwMDAwMDAxNzggMDAwMDAgbiAKMDAwMDAwMDQ1NyAwMDAwMCBuIAp0cmFpbGVyCiAg
                        PDwgIC9Sb290IDEgMCBSCiAgICAgIC9TaXplIDUKICA+PgpzdGFydHhyZWYKNTY1CiUlRU9GCg=='
        ];
                
        /* PRO DANZA */

        $lineaEstables = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Estables%')
                            ->first();

        $lineaPuntuales = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Puntuales%')
                            ->first();

        $lineaSalas = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Salas%')
                            ->first();

        $lineaAsociaciones = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Asociaciones%')
                            ->first();
        
        for($i=1; $i<26; $i++){
            
            $params_exp = [
                'numero' => 'PRD'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaEstables->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }

        for($i=26; $i<51; $i++){
            
            $params_exp = [
                'numero' => 'PRD'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaPuntuales->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }

        for($i=51; $i<76; $i++){
            
            $params_exp = [
                'numero' => 'PRD'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaSalas->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }

        for($i=76; $i<101; $i++){
            
            $params_exp = [
                'numero' => 'PRD'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaAsociaciones->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }
        
        /* PRO TEATRO */
        
        $linea2 = DB::table('lineas')->select('lineas.id as linea_id')
                            ->join('fondos', 'fondos.id', '=', 'lineas.fondo_id')
                            ->where('fondos.codigo', 'PRT')->first();


        $lineaSalas = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Salas Teatrales%')
                            ->first();

        $lineaEspeciales = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Proyectos Especiales%')
                            ->first();

        $lineaEventuales = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Grupos Eventuales%')
                            ->first();

        $lineaEstables = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Grupos Estables%')
                            ->first();
                            
        $lineaComunitarios = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Grupos Comunitarios%')
                            ->first();

                            
        $params_exp = [
            'numero' => 'EX-2017-01129285--MGEYA-DGTALMC',
            'proyecto_nombre' => 'La puerta azul',
            'responsable_nombre' => 'Fernandez Pedro Rodrigo',
            'nombre_grupo' => 'La casa del árbol',
            'responsable_desc' => 'Es una obra que busca reflexionar acerca de los sueños de cada persona, representándose por la puerta azul, dado que se cumplirán si se pasa la misma, siendo la metáfora que cada persona debe avanzar y derribar un obstáculo para lograr sus objetivos.',
            'observaciones' => 'Buena presentación del proyecto.',
            'fecha_presentacion' => 'Agosto',
            'responsable_dni'=>'22222284',
            'responsable_cuil'=>'32222222841',
            'monto_solicitado' => 10000,
            'monto_otorgado' => 0,
            'linea_id'=> $lineaComunitarios->linea_id
        ];
        
        $expediente = new Expediente();
        $expediente->fill($params_exp);
        $expediente->save();
        
        $documento = new Documento();
        $params_doc['expediente_id'] = $expediente->id;
        $documento->fill($params_doc);
        $documento->save();
        
        $params_exp = [
            'numero' => 'PRT0004',
            'proyecto_nombre' => 'Eco Teatro',
            'responsable_nombre' => 'Jorge Sanchez',
            'nombre_grupo' => 'Los redondos',
            'responsable_desc' => 'Ecologia y Teatro.',
            'observaciones' => 'Pobre presentación del proyecto.',
            'fecha_presentacion' => '2017-01-02',
            'monto_solicitado' => 7000.5,
            'monto_otorgado' => 0.0,
            'linea_id'=> $linea2->linea_id
        ]; 
        
        $expediente = new Expediente();
        $expediente->fill($params_exp);
        $expediente->save();
        
        $documento = new Documento();
        $params_doc['expediente_id'] = $expediente->id;
        $documento->fill($params_doc);
        $documento->save();

        for($i=10; $i<100; $i++){
            
            $params_exp = [
                'numero' => 'PRT'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'nombre_grupo' => 'Los redondos '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $linea2->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }

        for($i=110; $i<200; $i++){
            
            $params_exp = [
                'numero' => 'PRT'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'nombre_grupo' => 'Los redondos '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaSalas->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }

        for($i=210; $i<300; $i++){
            
            $params_exp = [
                'numero' => 'PRT'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'nombre_grupo' => 'Los redondos '.$i,
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaEspeciales->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }

        for($i=310; $i<400; $i++){
            
            $params_exp = [
                'numero' => 'PRT'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'nombre_grupo' => 'Los redondos '.$i,
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaEstables->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }

        for($i=410; $i<500; $i++){
            
            $params_exp = [
                'numero' => 'PRT'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'nombre_grupo' => 'Los redondos '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaEventuales->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }
        
        /* BA MUSICA */

        $lineaClub = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Club de Música%')
                            ->first();

        $lineaGrupos = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Grupo de Músicos estable%')
                            ->first();

        $lineaSolistas = DB::table('lineas')->select('lineas.id as linea_id')
                            ->where('lineas.nombre', 'like', '%Músico Solista%')
                            ->first();

        for($i=10; $i<100; $i++){
            
            $params_exp = [
                'numero' => 'BAM'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaClub->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }

        for($i=110; $i<200; $i++){
            
            $params_exp = [
                'numero' => 'BAM'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaGrupos->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }

        for($i=210; $i<300; $i++){
            
            $params_exp = [
                'numero' => 'BAM'.str_pad($i,4,'0', STR_PAD_LEFT),
                'proyecto_nombre' => 'Nombre Proyecto '.$i,
                'responsable_nombre' => 'Responsable Proyecto '.$i,
                'responsable_dni' => '99999999',
                'responsable_cuil' => '20-12345676-'.$i,
                'responsable_desc' => 'Descripcion '.$i,
                'observaciones' => 'Observaciones '.$i,
                'fecha_presentacion' => '2017-01-02',
                'monto_solicitado' => 7000.5,
                'monto_otorgado' => 0.0,
                'linea_id'=> $lineaSolistas->linea_id
            ];
            
            $expediente = new Expediente();
            $expediente->fill($params_exp);
            $expediente->save();
            
            $documento = new Documento();
            $params_doc['expediente_id'] = $expediente->id;
            $documento->fill($params_doc);
            $documento->save();
            
        }
        
        
        
    }

}
