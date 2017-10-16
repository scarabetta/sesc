<?php

use Illuminate\Database\Seeder;

use App\VotacionOpcion;

class VotacionOpcionesTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        ################ VOTACIONES DEFINITIVAS ##############
        
        $tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'Prodanza')->first();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Pertinencia del proyecto en relación a los objetivos convocatoria 2014',
            'tipo_rta' => 'number',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();  
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Consistencia y singularidad artística del proyecto',
            'tipo_rta' => 'number',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Consistencia y viabilidad de las estrategias de producción y circulación',
            'tipo_rta' => 'number',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Relación entre el proyecto y la experiencia previa de los realizadores',
            'tipo_rta' => 'number',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Correspondencia  Presupuesto / Proyecto',
            'tipo_rta' => 'number',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Interés que suscita en el jurado',
            'tipo_rta' => 'number',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
	### Mecenazgo ###

	$tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'Mecenazgo')->first();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Interés para la Ciudad de Buenos Aires',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Carácter no lucrativo del proyecto',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Razonabilidad del Presupuesto',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Calidad e Innovación',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Factibilidad',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Continuidad',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Experiencia e Idoneidad',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Circuito y Público Destinatario',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Congestión y Trabajo en Red',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Capacitación',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Valores',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Subsidiaridad',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Evaluación',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();


        ############ PROTEATRO ###############

        ### Grupos ###
        $tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'PRT-Grupos')->first();

        # Material #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Material',
            'tipo_rta' => 'material',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Artistas #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Artistas involucrados',
            'tipo_rta' => 'artistas',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Propuesta #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Propuesta artística',
            'tipo_rta' => 'propuesta',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Diseño escenografia #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Diseño de escenografía y/o espacio escénico',
            'tipo_rta' => 'design',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Diseño vestuario #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Diseño de vestuario',
            'tipo_rta' => 'design',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Presupuesto #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Lógica presupuestaria',
            'tipo_rta' => 'presupuesto',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # General #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Propuesta general',
            'tipo_rta' => 'general',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Monto #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Monto',
            'tipo_rta' => 'monto_opcion',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        ### Salas ###
        $tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'Salas')->first();

        # Cultural #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Valor cultural/social',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Logica #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Lógica presupuestaria',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Infraestructura #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Infraestructura',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Anterior #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Programación anual del año pasado',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Propuesta #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Programación anual propuesta',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Sala #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Proyecto de sala',
            'tipo_rta' => 'boolean',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # General #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Propuesta general',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Monto #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Monto sugerido',
            'tipo_rta' => 'monto',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        ### Proyectos Especiales ###
        $tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'Especiales')->first();

        # Material #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Presentación del material',
            'tipo_rta' => 'material_especiales',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Propuesta #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Propuesta artística',
            'tipo_rta' => 'propuesta_especiales',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Antecedentes #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Antecedentes y experiencia del solicitante y/o equipo de trabajo',
            'tipo_rta' => 'antecedentes_especiales',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Logica pres #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Lógica presupuestaria',
            'tipo_rta' => 'presupuesto',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # General #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Propuesta general',
            'tipo_rta' => 'general',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Monto #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Monto',
            'tipo_rta' => 'monto_opcion',

        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();


        ############ BAMUSICA ############

        ### Club ###
        $tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'BAM-Club')->first();

        # Documentacion #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Documentación Personal (DNI,LC o LE) + cambio de domicilio si corresponde',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # cuit #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'CUIT/CUIL',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # estatuto #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Copia del Estatuto de la Entidad Responsable del Club de Música',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # autoridades #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Copia de la última acta de designación de Autoridades',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # inspeccion #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Copia de la inscripción en la Inspección General de Justicia / INAES',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        # propiedad #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Copia del Título de Propiedad, contrato de alquiler o Convenio de Comodato a nombre del responsable del club',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # habilitacion #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Copia de la Habilitación Transitoria o Habilitación expedida por DGHyP',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # presupuestos #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Presupuestos completos',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # eval gral #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Evaluación General: El proyecto ¿Fue aprobado?',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Monto #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Monto sugerido',
            'tipo_rta' => 'monto',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();


        ### Grupo-Solista ###
        $tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'BAM-Grupo-Solista')->first();

        # formulario #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Formulario completo',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Documentacion #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Documentación Personal (DNI,LC o LE) + cambio de domicilio si corresponde',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # cuit #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'CUIT/CUIL',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # CV #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Curriculum Músicos',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # presupuestos #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Presupuestos completos',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # eval gral #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Evaluación General: El proyecto ¿Fue aprobado?',
            'tipo_rta' => 'boolean',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        # Monto #
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Monto sugerido',
            'tipo_rta' => 'monto',
        ];

        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        ############ PRODANZA ############

        $tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'PRD-Todas')->first();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Pertinencia del proyecto en relación a los objetivos convocatoria',
            'tipo_rta' => 'number',  
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Consistencia y singularidad artística del proyecto',
            'tipo_rta' => 'number',  
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Consistencia y viabilidad de las estrategias de producción y circulación',
            'tipo_rta' => 'number',  
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Relación entre el proyecto y la experiencia previa de los realizadores',
            'tipo_rta' => 'number',  
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Correspondencia entre presupuesto y proyecto',
            'tipo_rta' => 'number',  
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Interés que suscita en el jurado',
            'tipo_rta' => 'number',  
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();

        ################ VOTACIONES DE PRUEBA ################
        
        $tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'SiNo')->first();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => '¿Le parece un proyecto adecuado?',
            'tipo_rta' => 'boolean',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();        
        
        /* Otro tipo */
        
        $tipo_vot = DB::table('tipo_votaciones')->where('nombre', 'Porcentual')->first();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Evaluación de la presentación del proyecto',
            'tipo_rta' => 'number',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => '¿Presenta un plan realizable?',
            'tipo_rta' => 'number',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        $params_vot_opcion = [
            'tipo_votacion_id' => $tipo_vot->id,
            'pregunta' => 'Evaluación de la idea del proyecto',
            'tipo_rta' => 'number',
            
        ];
        
        $opcion = new VotacionOpcion();
        $opcion->fill($params_vot_opcion);
        $opcion->save();
        
        
        
    }

}
