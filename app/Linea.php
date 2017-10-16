<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model {

    protected static $takePlus = ['Grupos Estables','Grupos Eventuales'];

    protected static $extras = [
        '0' => 'Autor Extranjero o Clásicos Internacionales',
        '7' => 'por Autor Nacional',
        '4' => 'por Adaptación de Obra',
    ];

    public function expedientes(){
        return $this->hasMany('App\Expediente');
    }

    public function presupuestos(){
        return $this->hasMany('App\Presupuesto');
    }
    
    public function tipovotacion(){
        return $this->belongsTo('App\TipoVotacion', 'tipo_votacion_id');
    }

    public function fondo(){
        return $this->belongsTo('App\Fondo', 'fondo_id');
    }

    public function acceptsPlus(){
        return in_array($this->nombre, self::$takePlus);
    }

    public function extraOptions(){
        return self::$extras;
    }

    public static function validAmounts($lineasMontos){
        $valid = true;

        foreach ($lineasMontos as $lineaId => $monto) {
            if(Presupuesto::getLatestByLinea($lineaId) < $monto){
                $valid = false;
            }
        }

        return $valid;
    }

    public static function saveAmounts($lineasMontos){
        
        foreach ($lineasMontos as $lineaId => $monto) {
            $new = Presupuesto::getLatestByLinea($lineaId) - $monto;
            Presupuesto::setLatestByLinea($lineaId, $new);
        }
    }

}
