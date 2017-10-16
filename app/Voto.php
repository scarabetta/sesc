<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model {

    protected $fillable = ['user_id', 'expediente_id', 'comentario', 'monto', 'created_at'];

	public function expediente(){
        return $this->belongsTo('App\Expediente', 'expediente_id');
    }
    
    public function usuario(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function respuestas(){
        return $this->hasMany('App\Respuesta');
    }

}
