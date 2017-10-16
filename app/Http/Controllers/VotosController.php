<?php

namespace App\Http\Controllers;

use Request;
use Auth;

use App\Voto;
use App\Respuesta;

use App\Http\Requests as Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class VotosController extends Controller{
    
    
    public function vote($id_expediente){

        $data = Request::all();
        
        if(!isset($data['opcion']) || empty($data['opcion'])){
            return redirect('/expedientes/view/'. $id_expediente)->with('alert-warning','Debe elegir todas las opciones al momento de votar.');
        }
        
        foreach ($data['opcion'] as $opt_id => $rta) {
            if($rta == ''){
                return redirect('/expedientes/view/'. $id_expediente)->with('alert-warning','Debe elegir todas las opciones al momento de votar.');
            }
        }
        

        // actualizo o creo el voto
        $voto = Voto::firstOrNew(['expediente_id' => $id_expediente, 'user_id' => $data['user_id']]);
        $voto->fill($data);
        $voto->save();

        if(isset($data['opcion']) && !empty($data['opcion'])){
            foreach ($data['opcion'] as $opt_id => $rta) {
                $respuesta = Respuesta::firstOrNew(['voto_id'=>$voto->id, 'opcion_id'=>$opt_id]);
                $respuesta->respuesta = $rta;
                $respuesta->save();
            }
        }
        return redirect('/expedientes/view/'. $id_expediente)->with('alert-success','El voto ha sido guardado con éxito.');
    }
    
    
}
