<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Presupuesto extends Model {
  
    protected $fillable = ['year', 'linea_id', 'monto'];

    public function linea()
    {
        return $this->belongsTo('App\Linea');
    }
    
    public static function getAllByFondo($fondo_id){
        
        $presupuestos = Expediente::select(['presupuestos.*'])
                            ->join('lineas', 'lineas.id', '=', 'presupuestos.linea_id')
                            ->join('fondos', 'fondos.id', '=', 'lineas.fondo_id')
                            ->from('presupuestos')
                            ->where('fondos.id', $fondo_id)
                            ->orderBy('year','DESC')
                            ->orderBy('lineas.nombre','ASC')
                            ->get();
                            
        return $presupuestos;
    }

    public static function getLatestByLinea($linea_id){
        
        $presupuestos = Presupuesto::select('monto')
                            ->where('linea_id', $linea_id)
                            ->orderBy('year','DESC')
                            ->limit(1)
                            ->first();
                            
        return $presupuestos['monto'];
    }

    public static function setLatestByLinea($linea_id, $new_budget){
        
        $presupuestos = Presupuesto::where('linea_id', $linea_id)
                            ->orderBy('year','DESC')
                            ->limit(1)
                            ->first();
        if(empty($presupuestos)){
            return;
        }

        $year = $presupuestos['year'];
        $linea = $presupuestos['linea_id'];                    
        DB::statement("UPDATE presupuestos SET monto = '$new_budget' where year = $year and linea_id = $linea");
    }
    
}
