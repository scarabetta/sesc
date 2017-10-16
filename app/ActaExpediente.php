<?php namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class ActaExpediente extends Model {

	//
    protected $table = 'acta_expediente';
    public $timestamps = false;

    protected $fillable = ['acta_id', 'expediente_id', 'observaciones', 'nroregistro', 'respuesta_ciudadano', 'motivo_respuesta_ciudadano'];

    public function expediente(){
        return $this->belongsTo('App\Expediente', 'expediente_id');
    }

    public static function ultimaActa($expediente_id){
        $acta = ActaExpediente::select(DB::raw('max(acta_id) as idActa'))
            ->where('expediente_id', $expediente_id)
            ->first();
    
        return $acta->idActa;
    }

}
