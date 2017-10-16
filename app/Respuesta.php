<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model {

	protected $fillable = ['voto_id', 'opcion_id', 'respuesta', 'created_at'];

    protected static $siNo = [
        '1' => 'Si',
        '0' => 'No'
    ];

    public function voto(){
        return $this->belongsTo('App\Voto', 'voto_id');
    }

    public function opcion(){
        return $this->belongsTo('App\VotacionOpcion', 'opcion_id');
    }

    public function getString(){
        //print_r($this->opcion); die;
        return VotacionOpcion::toString($this->opcion->tipo_rta, $this->respuesta);
        if($this->opcion->tipo_votacion_id == 'SiNo'){
            return self::$siNo[$this->respuesta];
        }else{
            return $this->respuesta;
        }
    }

}
