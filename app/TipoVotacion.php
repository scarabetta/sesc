<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoVotacion extends Model {

	//
    protected $table = 'tipo_votaciones';
    
    public function opciones()
    {
        return $this->hasMany('App\VotacionOpcion', 'tipo_votacion_id');
    }
    
    public function lineas()
    {
        return $this->hasMany('App\Linea', 'linea_id');
    }

}
