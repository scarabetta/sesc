<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Expediente;
use App\Documento;
use App\Linea;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Log;

class RestExpedienteController extends Controller {


	/**
	 * Asocia documentos a un expediente
	 * 
	 * @return Response
     * curl --noproxy subsidios.smack.ag.local -H "Content-Type: application/json" -X POST -d '{"documento":{"acronimo":"IF", "data":"JVBERi0xLjEKJcKlwrHDqwoKMSAwIG9iagogIDw8IC9UeXBlIC9DYXRhbG9nCiAgICAgL1BhZ2VzIDIgMCBSCiAgPj4KZW5kb2JqCgoyIDAgb2JqCiAgPDwgL1R5cGUgL1BhZ2VzCiAgICAgL0tpZHMgWzMgMCBSXQogICAgIC9Db3VudCAxCiAgICAgL01lZGlhQm94IFswIDAgMzAwIDE0NF0KICA+PgplbmRvYmoKCjMgMCBvYmoKICA8PCAgL1R5cGUgL1BhZ2UKICAgICAgL1BhcmVudCAyIDAgUgogICAgICAvUmVzb3VyY2VzCiAgICAgICA8PCAvRm9udAogICAgICAgICAgIDw8IC9GMQogICAgICAgICAgICAgICA8PCAvVHlwZSAvRm9udAogICAgICAgICAgICAgICAgICAvU3VidHlwZSAvVHlwZTEKICAgICAgICAgICAgICAgICAgL0Jhc2VGb250IC9UaW1lcy1Sb21hbgogICAgICAgICAgICAgICA+PgogICAgICAgICAgID4+CiAgICAgICA+PgogICAgICAvQ29udGVudHMgNCAwIFIKICA+PgplbmRvYmoKCjQgMCBvYmoKICA8PCAvTGVuZ3RoIDU1ID4+CnN0cmVhbQogIEJUCiAgICAvRjEgMTggVGYKICAgIDAgMCBUZAogICAgKEhlbGxvIFdvcmxkKSBUagogIEVUCmVuZHN0cmVhbQplbmRvYmoKCnhyZWYKMCA1CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMDAxOCAwMDAwMCBuIAowMDAwMDAwMDc3IDAwMDAwIG4gCjAwMDAwMDAxNzggMDAwMDAgbiAKMDAwMDAwMDQ1NyAwMDAwMCBuIAp0cmFpbGVyCiAgPDwgIC9Sb290IDEgMCBSCiAgICAgIC9TaXplIDUKICA+PgpzdGFydHhyZWYKNTY1CiUlRU9GCg==","nombre":"ACTA-MGYDA-8231232-  -BLABLA"}}' http://subsidios.smack.ag.local/api/expedientes/EX-2017-01057513-%20%20%20-MGEYA-DGTALMC/documentos
	 */
	public function addDocumento($nroexpediente)
	{
    $response_code = 200;
    $resultado = 'Documento insertado con exito.';
    
    $input = Input::all();
    
    try{

        $acronimo = $input['documento']['acronimo'];
        $data = $input['documento']['data'];
        $nombre = $input['documento']['nombre'];
    
        $expediente = Expediente::select('*')
                                    ->where('numero', $nroexpediente)->first();
                                    
        if(isset($expediente->id)){
            
            $params_doc = [
                'acronimo' => $acronimo,
                'data' =>  $data,
                'expediente_id' =>  $expediente->id,
                'nombre' => $nombre
            ];
                
            $documento = new Documento();
            $documento->fill($params_doc);
            $documento->save();
            
            
        }else{
            
            $response_code = 400;
            $resultado = 'ERROR: El expediente no existe.';
            
            return Response::json(
                array('resultado' => $resultado),
                $response_code
            );
          
        }
    
    }catch(\Exception $e){
        $response_code = 400;

        $resultado = 'ERROR: Error inesperado. ('.$e->getMessage().')';
        Log::error("SC API: ".$e->getMessage());
        return Response::json(
            array('resultado' => $resultado),
            $response_code
        );
    }
    
		return Response::json(
        array('resultado' => $resultado),
        $response_code
    );
	}

	/**
	 * Crea un nuevo expediente
	 * 
	 * @return Response
     * curl --noproxy subsidios.smack.ag.local -H "Content-Type: application/json" -X POST -d '{"proyecto":{"fondo":"Proteatro","linea":"Grupos Comunitarios","nro-expediente":"EX-2017-01057513-   -MGEYA-DGTALMC","nombre-proyecto":"NOMBRE DEL PROYECTO","nombre-responsable":"NOMBRE DEL RESPONSABLE","nro-registro":"12345","nro-documento":"9999999","cuit-cuil":"9999999","descripcion-proyecto":"DESCRIPCION DEL PROYECTO","fecha-estimada-presentacion":"2017-10-09","monto-solicitado":"15000.0", "nombre-grupo":"Nombre del grupo","adjuntos":{"documento":[{"acronimo":"IFMAU","data":"http://www.google.com"},{"acronimo":"IFFSO","data":"JVBERi0xLjEKJcKlwrHDqwoKMSAwIG9iagogIDw8IC9UeXBlIC9DYXRhbG9nCiAgICAgL1BhZ2VzIDIgMCBSCiAgPj4KZW5kb2JqCgoyIDAgb2JqCiAgPDwgL1R5cGUgL1BhZ2VzCiAgICAgL0tpZHMgWzMgMCBSXQogICAgIC9Db3VudCAxCiAgICAgL01lZGlhQm94IFswIDAgMzAwIDE0NF0KICA+PgplbmRvYmoKCjMgMCBvYmoKICA8PCAgL1R5cGUgL1BhZ2UKICAgICAgL1BhcmVudCAyIDAgUgogICAgICAvUmVzb3VyY2VzCiAgICAgICA8PCAvRm9udAogICAgICAgICAgIDw8IC9GMQogICAgICAgICAgICAgICA8PCAvVHlwZSAvRm9udAogICAgICAgICAgICAgICAgICAvU3VidHlwZSAvVHlwZTEKICAgICAgICAgICAgICAgICAgL0Jhc2VGb250IC9UaW1lcy1Sb21hbgogICAgICAgICAgICAgICA+PgogICAgICAgICAgID4+CiAgICAgICA+PgogICAgICAvQ29udGVudHMgNCAwIFIKICA+PgplbmRvYmoKCjQgMCBvYmoKICA8PCAvTGVuZ3RoIDU1ID4+CnN0cmVhbQogIEJUCiAgICAvRjEgMTggVGYKICAgIDAgMCBUZAogICAgKEhlbGxvIFdvcmxkKSBUagogIEVUCmVuZHN0cmVhbQplbmRvYmoKCnhyZWYKMCA1CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMDAxOCAwMDAwMCBuIAowMDAwMDAwMDc3IDAwMDAwIG4gCjAwMDAwMDAxNzggMDAwMDAgbiAKMDAwMDAwMDQ1NyAwMDAwMCBuIAp0cmFpbGVyCiAgPDwgIC9Sb290IDEgMCBSCiAgICAgIC9TaXplIDUKICA+PgpzdGFydHhyZWYKNTY1CiUlRU9GCg=="}]}}}' http://subsidios.smack.ag.local/api/expedientes
	 */
	public function addExpediente()
	{
		$input = Input::all();
        
        $response_code = 200;
        $resultado = '';

        try{
        
        if(!isset($input['proyecto']['fondo']) || !isset($input['proyecto']['linea'])){
            $response_code = 400;
            $resultado = 'ERROR: El objeto JSON recibido no tiene el formato esperado.';
            
            return Response::json(
                array('resultado' => $resultado),
                $response_code
            );
        }

        $fondo_str = $input['proyecto']['fondo'];
        $linea_str = $input['proyecto']['linea'];
        
        
        
            // Chequeo de fondo / linea válida
            $linea = Linea::select('lineas.id as linea_id')
                                ->join('fondos', 'fondos.id', '=', 'lineas.fondo_id')
                                ->where('fondos.nombre', $fondo_str)->where('lineas.nombre', $linea_str)->first();
            
            if(!isset($linea->linea_id)){
                
                $response_code = 400;
                $resultado = 'ERROR: El Fondo o la linea provista no existen.';
                
                return Response::json(
                    array('resultado' => $resultado),
                    $response_code
                );
                
            }
            
            // No debe existir el expediente
            $expediente = Expediente::select('*')
                                ->where('numero', $input['proyecto']['nro-expediente'])->first();
                                
            if(isset($expediente->id)){
                
                $response_code = 400;
                $resultado = 'ERROR: Ya existe un expediente con ese numero.';
                
                return Response::json(
                    array('resultado' => $resultado),
                    $response_code
                );
                
            }
            
            $documentos = $input['proyecto']['adjuntos']['documento'];
            
            
            
            $params_exp = [
                'numero' => $input['proyecto']['nro-expediente'],
                'proyecto_nombre' => $input['proyecto']['nombre-proyecto'],
                'responsable_nombre' => $input['proyecto']['nombre-responsable'],
                'responsable_desc' => $input['proyecto']['descripcion-proyecto'],
                'observaciones' => '',
                'nombre_grupo' => $input['proyecto']['nombre-grupo'],
                'fecha_presentacion' => $input['proyecto']['fecha-estimada-presentacion'],
                'monto_solicitado' => $input['proyecto']['monto-solicitado'],
                'monto_otorgado' => 0.0,
                'linea_id'=> $linea->linea_id,
                'nro_registro'=> $input['proyecto']['nro-registro'],
                'responsable_dni'=> $input['proyecto']['nro-documento'],
                'responsable_cuil'=> $input['proyecto']['cuit-cuil'],
            ];
            
            $expediente = new Expediente;
            $expediente->fill($params_exp);
            $expediente->save();
            
            // Guardo sus documentos
            foreach($documentos as $doc){
                
                $params_doc = [
                    'acronimo' => $doc['acronimo'],
                    'data' =>  $doc['data'],
                    'expediente_id' =>  $expediente->id
                ];
                    
                $documento = new Documento();
                $documento->fill($params_doc);
                $documento->save();
                
            }
        
        }catch(\Exception $e){
            $response_code = 400;

            $resultado = 'ERROR: Error inesperado. ('.$e->getMessage().')';

            Log::error("SC API: ".$e->getMessage());
            
            // Vuelvo atras los cambios
            if(isset($input['proyecto']['nro-expediente'])){
                $expediente = Expediente::select('*')
                                    ->where('numero', $input['proyecto']['nro-expediente'])->first();
                                    
                if(isset($expediente->id)){
                    foreach($expediente->documentos() as $doc){
                        $doc->delete();
                    }
                    $expediente->delete();
                }
            }
        
            return Response::json(
                array('resultado' => $resultado),
                $response_code
            );
        }
        
        $resultado = 'Expediente insertado con exito.';
    
        return Response::json(
            array('resultado' => $resultado),
            $response_code
        );
	}
    
    /**
	 * Rechaza un nuevo expediente
	 * 
	 * @return Response
     * curl --noproxy subsidios.smack.ag.local -H "Content-Type: application/json" -X POST -d '{"motivo":""}' http://subsidios.smack.ag.local/api/expedientes/PRT0004/rechazos
	 */
	public function rechazarExpediente($nroexpediente)
	{
		$input = Input::all();
        
        $response_code = 200;
        $resultado = '';
        
        try{
        
            if(!isset($input['motivo'])){
                $response_code = 400;
                $resultado = 'ERROR: El objeto JSON recibido no tiene el formato esperado.';
                
                return Response::json(
                    array('resultado' => $resultado),
                    $response_code
                );
            }
            
            $expediente = Expediente::select('*')
                                    ->where('numero', $nroexpediente)->first();
                                    
            if(isset($expediente->id)){
                
                $expediente->ciudadanoRechaza($input['motivo']); 
                
            }else{
                $response_code = 400;

                $resultado = 'ERROR: El expediente no existe.';
                
                return Response::json(
                    array('resultado' => $resultado),
                    $response_code
                );
            }

        }catch(\Exception $e){
            $response_code = 400;

            $resultado = 'ERROR: Error inesperado. ('.$e->getMessage().')';
            Log::error("SC API: ".$e->getMessage());
            
            return Response::json(
                array('resultado' => $resultado),
                $response_code
            );
        }
        
        $resultado = 'Rechazo del expediente realizado con exito';
        
        return Response::json(
                array('resultado' => $resultado),
                $response_code
            );
        
    }

    /**
     * Cierra un acta en SADE - WS de prueba del receptor
     * 
     * @return Response
     * curl --noproxy subsidios.smack.ag.local -H "Content-Type: application/json" -X POST -d '{"acta":"VE1dsad1VTAded23df23fffVA==","proyecto":[{"expediente":"RE-2017-01292482-   -DGGDOC","notificacion":"VEVTAded23df23fffVA=="},{"expediente":"RE-2017-01292483-   -DGGDOC","notificacion":"VEVsdawdTAded23df23fffVA=="},{"expediente":"RE-2017-01292484-   -DGGDOC","notificacion":"VEVTAdedasdasd23df23fffVA=="}]}' http://subsidios.smack.ag.local/esb/servicios/sesc/cerrar_reunion
     */

    public function cerrarActa(){

        $response_code = 200;
        $resultado = '{"acta":"ACTA-'.md5(time()).'","notificacion":[{"expediente":"EXP01","gedo":"NOTA1"},{"expediente":"PRT0010","gedo":"NOTA2"},{"expediente":"PRT0011","gedo":"NOTA3"}]}';
        
        return Response(
            $resultado,
            $response_code
        );

    }

	

}
