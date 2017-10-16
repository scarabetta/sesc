<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VotacionOpcion extends Model {

	//
    protected $table = 'votacion_opciones';

    protected static $opciones = [
        'boolean' => ['si','no'],
        'material' => ['completo','detallado','escaso','incompleto'],
        'artistas' => ['profesionales','artistas emergentes','principiantes','en formación'],
        'propuesta' => ['fundamentada','poco fundamentada','confusa','debil'],
        'design' => ['detallado','sin detalles','escaso','no presenta'],
        'presupuesto' => ['ajustada','excesiva','insuficiente'],
        'general' => ['excelente','muy bueno','bueno','regular','flojo'],
        'monto_opcion' => ['denegar','minimo','porcentual','maximo'],
        'material_especiales' => ['detallado','escaso','incompleto'],
        'propuesta_especiales' => ['fundamentada','poco fundamentada'],
        'antecedentes_especiales' => ['profesionales','artistas emergentes','en formacion'],
    ];
    
    public function tipovotacion()
    {
        return $this->belongsTo('App\TipoVotacion', 'tipo_votacion_id');
    }

    public function opcionesRta(){
        return self::$opciones[$this->tipo_rta];
    }

    public static function toString($tipo, $rta){
        if(array_key_exists($rta, self::$opciones[$tipo])){
            return self::$opciones[$tipo][$rta];
        }else{
            return $rta;
        }
    }
    
    public static function getOptionIndex($tipo,$respuesta){
      return array_search($respuesta,self::$opciones[$tipo]);
    }

}
