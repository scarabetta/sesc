<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use DB;

use App\Acta;
use App\Expediente;
use App\ActaExpediente;
use App\Fondo;
use App\User;
use App\Linea;
use PDF;
use Excel;
use GuzzleHttp;
use Log;

use App\Http\Requests as Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ActasController extends Controller
{

    public function create(){
        
        try{
            // me fijo si no hay un acta activa
            $existe = Acta::getOpenByFondo(Auth::user()->fondo->id);
            if(!empty($existe)){
                return redirect('/reunion/ver/'. $existe->id)->with('message', 'Debe finalizar la reunión existente antes de comenzar una nueva');
            }
            
            $data = Request::all();
            $acta = new Acta();
            $acta->estado = Acta::ESTADO_ABIERTA;
            // guardo el numero de acta
            $acta->save();
            $acta->generateNumber(Auth::user()->fondo->id);
            
            // $value = expediente_id
            if(isset($data['expedientes']) && !empty($data['expedientes'])){
                foreach ($data['expedientes'] as $key => $value) {
                    $actaExpediente = new ActaExpediente(['acta_id' => $acta->id, 'expediente_id' => $value]);
                    $actaExpediente->save();
                }
            }
            
            // redirijo a la vista de edicion
            return redirect('reunion/ver/'.$acta->id)->with('alert-success','Reunión iniciada, haga click en Guardar para ir conservando los cambios de la misma.');
        
        }catch(\Exception $e){
            Log::error("SC INICIAR_REUNION: ".$e);
            return redirect('expedientes')->with('alert-danger','Ocurrió un problema al iniciar la reunión.');
            
        }
        
    }
    
    public function view($id){
      
        $acta = Acta::find($id);

        if(!isset($acta->id)){
          return redirect('expedientes')->with('alert-danger','Ocurrió un problema al acceder a la reunión.');
        }

        if($acta->estado == Acta::ESTADO_ABIERTA){
            $fondo = Fondo::find(Auth::user()->fondo->id);
            $jueces = $fondo->getJuecesYCoordinadores();

            $expedientes = $acta->expedientes;
            // DEPRECATED: lists -> plucks, >= 5.2
            $jueces_seleccionados = $acta->users()->lists('id')->toArray();

            return view('actas.index', [
                  'acta_id' => $id,
                  'acta'=> $acta,
                  'expedientes' => $expedientes,
                  'jueces' => $jueces,
                  'jueces_seleccionados'=>$jueces_seleccionados,
                  'coordinador'=>Auth::user()
                  ]);   
        }else{
            return view('actas.print', ['acta' => $acta]);
        }
            
    }

    public function save(){
      
      try {
        
        $data = Request::all();
        
        $acta_id = $data['acta_id'];
        $acta = Acta::find($acta_id);
        
        $nrosregistro = isset($data['expedientes_nroregistro']) ? $data['expedientes_nroregistro'] : array();
        $jueces = isset($data['jueces']) ? $data['jueces'] : array();
        $montosTemp = isset($data['expedientes_montos']) ? $data['expedientes_montos'] : array();
        $total = array();
        foreach ($montosTemp as $linea => $valores) {
          // sumo totales por linea para chequear que no se pasen
          $total[$linea] = array_sum($valores);

          // armo montos para guardar
          foreach ($valores as $key => $value) {
            $montos[$key] = $value;
          } 
        }

        // chequear montos validos
        if(!Linea::validAmounts($total)){
          return json_encode([
              'divClass' => 'danger', 
              'message' => 'Los montos asignados superan el presupuesto disponible para alguna de las líneas'
            ]);
        }else{
          // si estoy cerrando el acta resto los montos a cada linea
          if($acta->estado == Acta::ESTADO_ABIERTA && $data['close'] == 1){
            Linea::saveAmounts($total);
          }
        }
        
        $estados = $data['expedientes_estados'];
        $observaciones = isset($data['expedientes_observaciones']) ? $data['expedientes_observaciones'] : array();
        
        // Agrego al coordinador
        $jueces[] = Auth::user()->id;
        
        $acta->users()->detach();
        
        if(count($jueces)){
          $acta->users()->attach($jueces);
        }
        
        foreach($acta->expedientes as $expediente){
          $expediente->pivot->estado = $estados[$expediente->id];
          $expediente->pivot->observaciones = $observaciones[$expediente->id];
          if(isset($nrosregistro[$expediente->id])){
            $expediente->pivot->nroregistro = $nrosregistro[$expediente->id];
          }

          // si la linea del expediente acepta plus
          if($expediente->linea->acceptsPlus()){
            if(array_key_exists($expediente->id, $data['expedientes_plus'])){
              $expediente->pivot->plus = $data['expedientes_plus'][$expediente->id];
            }
          }

          $expediente->pivot->save();
          
          $exp = Expediente::find($expediente->id);
          $exp->monto_otorgado = isset($montos[$expediente->id]) ? floatval($montos[$expediente->id]) : 0.0;
          $exp->save();
        }
        
        $acta->save();

        return json_encode([
          'divClass' => 'success', 
          'message' => 'La reunión se guardó con éxito'
        ]);
      } catch (\Exception $e) {

        return json_encode([
              'divClass' => 'danger', 
              'message' => 'Ocurrió un error al intentar guardar la reunión. Por favor verifique los datos']);
      }
    }
    
    /* Este metodo cierra definitivamente la reunion
     * enviando las notificaciones al WS de SADE
     */ 
    public function terminar(){
        
        try{
      
            $data = Request::all();
            $acta_id = $data['acta_id'];

            $acta = Acta::find($acta_id);

            if(isset($data['acta_firmada'])){

                $file = $data['acta_firmada'];

                if ($file->isValid()) {
                    
                      $nombre_adjunto = 'acta_firmada_'.($acta->id).'.'.$file->getClientOriginalExtension();
                    
                      $destinationPath = 'uploads';
                      $file->move($destinationPath,$nombre_adjunto);

                      // Obtengo base64 del acta firmada para enviarla
                      $acta_path = public_path().'/uploads/'.$nombre_adjunto;
                      $type = pathinfo($acta_path, PATHINFO_EXTENSION);
                      $data = file_get_contents($acta_path);
                      $base64_acta = base64_encode($data);

                      // Obtengo base64 de las notificaciones
                      $expedientes = [];
                      foreach ($acta->expedientes as $exp) {
                        if($exp->pivot->estado != 3){
                          $expediente_base64 = base64_encode($acta->prnt_expediente($exp->id));
                          $expedientes[] = array('expediente' => $exp->numero, 'notificacion' => $expediente_base64);
                        }
                      }

                      $data = [
                          'json' => [ 'acta' => $base64_acta,
                                      'proyecto' => $expedientes,
                                      'usuario_sade' => Auth::user()->usuario_sade
                                    ]
                      ];

                      $client = new GuzzleHttp\Client();
                      $response = $client->post(env('API_CERRAR_REUNION_URL'), $data);

                      if($response->getStatusCode() == 200){

                          $response_json = json_decode($response->getBody(), true);
                          $acta->nro_gedo = $response_json['acta'];
                          $acta->save();

                          /* Guardo los GEDO's de los expedientes */
                          foreach($response_json['notificacion'] as $expediente){
                              $nro_expediente = $expediente['expediente'];
                              $expediente_gedo = $expediente['gedo'];

                              $acta_exp = ActaExpediente::select('*')
                                          ->join('expedientes', 'expedientes.id', '=', 'acta_expediente.expediente_id')
                                          ->where('expedientes.numero', $nro_expediente)
                                          ->where('acta_expediente.acta_id', $acta->id)
                                          ->first();

                              if(!is_null($acta_exp)){
                                  DB::statement("UPDATE acta_expediente SET nro_gedo = '".$expediente_gedo."' where acta_expediente.acta_id = '".$acta->id."' and acta_expediente.expediente_id = '".$acta_exp->expediente_id."'");
                              }
                              
                          }

                          return redirect('/expedientes/');

                      }else{
                          Log::error("SC CERRAR_ACTA: ".$response->getStatusCode());
                          return redirect('reunion/close/'.$acta_id)->with('alert-danger', 'Ocurrió un problema al terminar la reunión.');
                      }   
              
                }else{
                    Log::error("SC CERRAR_ACTA: ".$file->getErrorMessage());
                    return redirect('reunion/close/'.$acta_id)->with('alert-danger','Ocurrio un problema al procesar el acta.');
                    
                }

            }else{

                return redirect('reunion/close/'.$acta_id)->with('alert-danger','Debe subir el acta firmada.');

            }

            
        }catch(\Exception $e){
            Log::error("SC CERRAR_ACTA: ".$e);
            return redirect('reunion/close/'.$acta_id)->with('alert-danger','Ocurrió un problema al terminar la reunión.');
            
        }
    
    }
    
    public function cancelar($acta_id){
        
        try{
            
            $acta = Acta::find($acta_id);
            
            DB::statement("DELETE FROM `acta_expediente` WHERE `acta_expediente`.`acta_id` ='".$acta->id."'");
            DB::statement("DELETE FROM `acta_user` WHERE `acta_user`.`acta_id` ='".$acta->id."'");
            
            $acta->delete();
        
            return redirect('expedientes')->with('alert-success','La reunión fue cancelada con éxito.');
        
        }catch(\Exception $e){
            Log::error("SC CANCELAR_REUNION: ".$e);
            return redirect('expedientes')->with('alert-danger','Ocurrió un problema al cancelar la reunión.');
            
        }
        
        
    }

    public static function prnt($id){
        $acta = Acta::find($id);
        $coord = Auth::user();

        return $acta->prnt($coord->fondo->id);
    }

    public static function prnt_notification($acta, $expediente){
        $acta = Acta::find($acta);
        return $acta->prnt_expediente($expediente);
    }

    public function close($id_acta){

      // fondo
      $fondo = Auth::user()->fondo->id;
      $acta = Acta::find($id_acta);
      $acta->estado = Acta::ESTADO_CERRADA;
      $acta->save();

      return view('actas.print', ['acta' => $acta]);
    }

    public function votos_excel($id_acta){

      // obtengo los expedientes en esta acta
      $enActa = ActaExpediente::where('acta_id', $id_acta)->get();
      
      // Generate and return the spreadsheet
      Excel::create('votos-'.$id_acta, function($excel) use ($enActa) {

          // Set the spreadsheet title, creator, and description
          $excel->setTitle('Votos');
          $excel->setCreator('Sistema de Subsidios');
          $excel->setDescription('Votos de los jurados');

          // idea: hacer una hoja por expediente
          $excel->sheet('sheet1', function($sheet) use ($enActa) {

            $first = true;
            foreach ($enActa as $item) {

                // primera fila - nombre del expediente
                $expediente = $item->expediente;
              
                $opciones = $expediente->linea->tipovotacion->opciones;
                $tipoSN = $expediente->linea->tipovotacion->nombre == 'SiNo';
                $opt = [''];
                foreach ($opciones as $opcion) {
                  $opt[] = $opcion->pregunta;
                }
                $sheet->appendRow($opt);
                $first = false; 

                // titulo del expediente
                $sheet->appendRow(array(
                    $expediente->proyecto_nombre. ' - ' .$expediente->linea->nombre
                ));

                // una linea por cada voto
                foreach ($expediente->votos as $voto) {
                    // armo un arreglo por cada linea
                    $rtas_voto = [$voto->usuario->name. ' ' .$voto->usuario->surename];
                    foreach($voto->respuestas as $rta){
                        $rtas_voto[] = $rta->getString();
                    }
                    $rtas_voto[] = $rta->monto;
                    $sheet->appendRow($rtas_voto);

                }
                $blank = array_fill(0, count($opt), '');
                $sheet->appendRow($blank);
            }
              
          });

      })->download('xlsx');

    }

}
