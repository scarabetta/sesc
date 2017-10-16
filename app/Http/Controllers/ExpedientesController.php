<?php

namespace App\Http\Controllers;

use Request;
use Response;
use Auth;

use App\Expediente;
use App\Voto;
use App\Presupuesto;
use App\Acta;
use App\Documento;
use App\Linea;

use App\Http\Requests as Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ExpedientesController extends Controller{
	
    
    public function list_all(){
		
		$expedientes = Expediente::getAllByFondo(Auth::user()->fondo->id);

        // TODO: buscar el acta solo si el usuario es coordinador
        $acta = Acta::getOpenByFondo(Auth::user()->fondo->id);
        $acta_id = (!empty($acta)) ? $acta->id : -1;
        
        if(Auth::user()->fondo->codigo == 'PRD'){
            $view = 'list_prd';
        }elseif(Auth::user()->fondo->codigo == 'PRT'){
            $view = 'list_prt';
        }elseif(Auth::user()->fondo->codigo == 'MZ'){
            $view = 'list_mz';
        }else{
            $view = 'list_bam';
        }
        
        return view('expedientes.'.$view, 
                    [
                        'expedientes' => $expedientes,
                        'acta_abierta' => $acta_id
                    ]);
    }
    
    public function list_archivadas(){
		
		$expedientes = Expediente::getArchivadosByFondo(Auth::user()->fondo->id);

        // TODO: buscar el acta solo si el usuario es coordinador
        $acta = Acta::getOpenByFondo(Auth::user()->fondo->id);
        $acta_id = (!empty($acta)) ? $acta->id : -1;

        return view('expedientes.list_archivadas', 
            ['expedientes' => $expedientes,
            'acta_abierta' => $acta_id]);
    }

    public function view($id){

        $expediente = Expediente::find($id);
        
        $otros_votos = Voto::where('expediente_id', $id)
                    ->where('user_id', '<>', Auth::user()->id)
                    ->join('users', 'users.id', '=', 'votos.user_id')->get();

        $votacion_opciones = $expediente->linea->tipovotacion->opciones;
        $voto_usuario = Voto::where('expediente_id', $id)
                    ->where('user_id', Auth::user()->id)->first();
        if(!empty($voto_usuario)){
            $respuestas = $voto_usuario->respuestas->keyBy('opcion_id');
        }

        $monto_disponible = Presupuesto::getLatestByLinea($expediente->linea->id);
        
        if(Auth::user()->fondo->codigo == 'PRD'){
            $view = 'view_prd';
        }elseif(Auth::user()->fondo->codigo == 'PRT'){
            $view = 'view_prt';
        }elseif(Auth::user()->fondo->codigo == 'MZ'){
            $view = 'view_mz';
        }else{
            $view = 'view_bam';
        }
        
        return view('expedientes.'.$view, [
            'expediente' => $expediente, 
            'votacion_opciones' => $votacion_opciones,
            'voto_usuario' => $voto_usuario,
            'respuestas' => isset($respuestas)?$respuestas:array(),
            'monto_disponible' => $monto_disponible,
            'documentos' => $expediente->documentos,
            'otros_votos' => $otros_votos
            ]);
    }
    
    public function view_documento($documento_id){
                
        $documento = Documento::find($documento_id);
        $documento->viewResponse();

    }

    public function view_archived($id){

        $expediente = Expediente::find($id);

        if(Auth::user()->fondo->codigo == 'PRD'){
            $view = 'view_prd';
        }elseif(Auth::user()->fondo->codigo == 'PRT'){
            $view = 'view_prt';
        }elseif(Auth::user()->fondo->codigo == 'MZ'){
            $view = 'view_mz';
        }else{
            $view = 'view_bam';
        }
        
        return view('expedientes.'. $view, [
            'expediente' => $expediente, 
            'archivo' => true,
            'documentos' => $expediente->documentos,
            ]);
    }

}
