<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use DB;

use App\Presupuesto;
use App\Fondo;

use App\Http\Requests as Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PresupuestosController extends Controller
{
	
    
    public function list_all(){

        $presupuestos = Presupuesto::getAllByFondo(Auth::user()->fondo->id);

        return view('presupuestos.list', ['presupuestos' => $presupuestos]);
        
    }

    public function add(){

        $fondo = Fondo::where('id', Auth::user()->fondo->id)->first();
        return view('presupuestos.add', [
            'lineas' => $fondo->lineas
            ]
        );
    }
    
    public function save(){

        try{
            
            $data = Request::all();
            
            if(!is_numeric($data['monto']) || $data['monto']<0){
                return redirect('montos/add')->with('alert-warning','El monto ingresado es inválido.');
            }
            
            $presupuesto = Presupuesto::select('*')->where('year', $data['year'])->where('linea_id', $data['linea_id'])->first();

            if(isset($presupuesto->year)){
                DB::statement("UPDATE presupuestos SET monto = '".$data['monto']."' where year = '".$data['year']."' and linea_id = ".$data['linea_id']);
            }else{
                $pres = new Presupuesto();
                $pres->fill($data);
                $pres->save();
            }
            
            return redirect('montos')->with('alert-success','El monto fue asignado con éxito');
          
        }catch(\Exception $e){
            return redirect('montos/add')->with('alert-warning','Ocurrió un error al intentar asignar el monto.');
        }
        
        
    }

}
