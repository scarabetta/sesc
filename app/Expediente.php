<?php namespace App;

use Auth;
use App\Voto;
use App\Acta;
use App\Respuesta;
use App\VotacionOpcion;
use App\ActaExpediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Expediente extends Model {
    
    const ESTADO_ACEPTADO = 1;
    const ESTADO_RECHAZADO = 2;
    const ESTADO_PENDIENTE = 3;
    const ESTADO_SUPLENTE = 4;
    const ESTADO_RECHAZADO_CIUDADANO = 5;
    
    protected $fillable = [
            'numero',
            'proyecto_nombre',
            'responsable_nombre',
            'responsable_desc',
            'observaciones',
            'nombre_grupo',
            'fecha_presentacion',
            'monto_solicitado',
            'monto_otorgado',
            'linea_id',
            'nro_gedo',
            'nro_registro',
            'responsable_dni',
            'responsable_cuil',
        ];

    public static $states = [
        1 => 'Aceptado',
        2 => 'Rechazado',
        3 => 'Pendiente',
        4 => 'Suplente',
        5 => 'Rechazado por ciudadano'
    ];

    protected static $documents = [ 
        'PRT' => ['Habilitación', 'Título de propiedad', 'Cumplimiento año anterior', 'Facturas', 'Presupuesto','Nota de compensación
    de servicios', 'Nota de autorización artística'],
        'BAM' => ['Formulario de solicitud', 'Habilitación','Título de propiedad', 'Cumplimiento año
    anterior', 'Facturas', 'Presupuesto','Nota de compensación de servicios'],
        'PRD' => ['Formulario de solicitud', 'Habilitación', 'Presupuesto', 'Contrato', 'Nota de autorización artística'], 
        'MZ' => ['Formulario de solicitud', 'Habilitación', 'Presupuesto', 'Contrato', 'Nota de autorización artística'], 
    ];
    
    public function linea(){
        return $this->belongsTo('App\Linea', 'linea_id');
    }

    public function votos(){
        return $this->hasMany('App\Voto');
    }
    
    public function documentos(){
        return $this->hasMany('App\Documento');
    }
    
    public function actas(){
        return $this->belongsToMany('App\Acta', 'acta_expediente');
    }

    public function fondo(){
        return $this->linea()->fondo->id;
    }

    public static function getAll(){
        return Expediente::all();
    }
    
    public static function getArchivadosByFondo($fondo_id){

        /* Buscamos los Expedientes que fueron tratados en algun acta con estado distinto a pendiente */
        
        $expedientes = Expediente::select(['expedientes.*', 'votos.comentario as voto_comentario', 'acta_expediente.estado as estado_exp',
                            'actas.id as acta_id', 'actas.nro_gedo', 'actas.nro_acta'])
                            ->join('lineas', 'lineas.id', '=', 'expedientes.linea_id')
                            ->join('fondos', 'fondos.id', '=', 'lineas.fondo_id')
                            ->leftJoin('votos', function($join) 
                            {
                             $join->on('votos.expediente_id', '=', 'expedientes.id');
                             $join->on('votos.user_id', '=',DB::raw(Auth::user()->id));
                            })
                            ->join('acta_expediente', 'expedientes.id', '=', 'acta_expediente.expediente_id')
                            ->join('actas', 'acta_expediente.acta_id', '=', 'actas.id')
                            ->where('fondos.id', $fondo_id)
                            ->where('acta_expediente.estado', '<>', Expediente::ESTADO_PENDIENTE)
                            ->where('actas.estado', '=', Acta::ESTADO_CERRADA)
                            ->groupBy('expedientes.id')
                            ->get();
                            
        return $expedientes;
    }

    public static function getAllByFondo($fondo_id){

        $expedientes = Expediente::select(  [ 'expedientes.*', 
                                            'votos.comentario as voto_comentario',
                                            'acta_expediente.respuesta_ciudadano as resp_ciudadano',
                                            'acta_expediente.motivo_respuesta_ciudadano as resp_motivo',
                                            ])
                            ->join('lineas', 'lineas.id', '=', 'expedientes.linea_id')
                            ->join('fondos', 'fondos.id', '=', 'lineas.fondo_id')
                            ->leftJoin('votos', function($join) 
                            {
                             $join->on('votos.expediente_id', '=', 'expedientes.id');
                             $join->on('votos.user_id', '=',DB::raw(Auth::user()->id));
                            })
                            ->leftJoin('acta_expediente', 'expedientes.id', '=', 'acta_expediente.expediente_id')
                            // Hago el join con la ultima acta
                            ->leftJoin('actas', 'acta_expediente.acta_id', '=', 'actas.id')
                            ->where('fondos.id', $fondo_id)
                            ->groupBy('expedientes.id')
                            ->orderBy('resp_ciudadano', 'DESC')
                            ->get();
       
        return $expedientes;
    }
    
    public function getResultadosEvaluacion(){
      
        $eval = '';
      
        if($this->linea->fondo->codigo == 'PRT'){
          
          if($this->linea->nombre == 'Salas Teatrales'){
            
            $tipo_votacion = $this->linea->tipo_votacion_id;
            $opcion_relevante = VotacionOpcion::select('id')->where('tipo_votacion_id', $tipo_votacion)->where('pregunta', 'Propuesta general')->first();
            $where = ['opcion_id' => $opcion_relevante['id']];

            // Calculo el promedio de monto sugerido por voto
            $avg_monto = Voto::select(DB::raw('avg(votos.monto) AS prom'))
            ->where('votos.expediente_id', $this->id)->first();
            
            $eval = 'Si: '.$this->getYes($where).' - No: '. $this->getNo($where).', Monto promedio: $'.number_format($avg_monto->prom, 2, ',', '');
            
          }else{

            // Total de votantes
            $votantes = Voto::where('votos.expediente_id', $this->id)->count();

            $eval = ' Votantes: '. $votantes;
          }
          
        }elseif($this->linea->fondo->codigo == 'BAM'){
            
            $tipo_votacion = $this->linea->tipo_votacion_id;
            $opcion_relevante = VotacionOpcion::select('id')->where('tipo_votacion_id', $tipo_votacion)->where('pregunta', 'Evaluación General: El proyecto ¿Fue aprobado?')->first();
            $where = ['opcion_id' => $opcion_relevante['id']];

            // Muestro cantidad de si y cantidad de no
            $eval .= 'Si: '. $this->getYes($where);
            $eval .= ' - No: '. $this->getNo($where);

        }elseif($this->linea->fondo->codigo == 'PRD'){

            // Calculo el promedio de monto sugerido por voto
            $avg_monto = Voto::select(DB::raw('avg(respuestas.respuesta) AS prom'))
                ->join('respuestas', function($join){
                    $join->on('respuestas.voto_id', '=', 'votos.id');
                })
                ->where('votos.expediente_id', $this->id)->first();

            $eval = number_format($avg_monto['prom'], 2);

        }else{
            
            $eval = '';
          
        }
        
        return $eval;
        
    }

    public function getYes($where = array()){
        $votosYes = $this->votos()->join('respuestas', function($join) use ($where){
                $join->on('votos.id', '=', 'respuestas.voto_id')
                    ->where('respuestas.respuesta', '=', DB::raw(VotacionOpcion::getOptionIndex('boolean','si')));
            
                foreach ($where as $field => $value) {
                    $join->where("respuestas.$field", '=', $value);
                }

            })->count();
        return $votosYes;
    }

    public function getNo($where = array()){
        
        $votosNo = $this->votos()->join('respuestas', function($join) use ($where){
                $join->on('votos.id', '=', 'respuestas.voto_id')
                    ->where('respuestas.respuesta', '=', DB::raw(VotacionOpcion::getOptionIndex('boolean','no')));
            
                foreach ($where as $field => $value) {
                    $join->where("respuestas.$field", '=', $value);
                }

            })->count();
        return $votosNo;

    }

    public function getEstadoActa($estado){
        return self::$states[$estado];
    }
    
    public function enReunion(){
      
      $reunionesActivas = Acta::select('actas.*')
            ->join('acta_expediente', 'acta_id', '=', 'actas.id')
            ->where('actas.estado', Acta::ESTADO_ABIERTA)
            ->where('acta_expediente.expediente_id', '=', $this->id)
            ->count();
      
      return ($reunionesActivas > 0);
    }

    public function getUltimoTratamientoReunion(){
        $exp = Expediente::select(['acta_expediente.*', 'actas.nro_acta as nro_acta', 'actas.nro_gedo as nro_gedo'])
                            ->leftJoin('acta_expediente', 'expedientes.id', '=', 'acta_expediente.expediente_id')
                            ->leftJoin('actas', 'acta_expediente.acta_id', '=', 'actas.id')
                            ->where('expedientes.id', $this->id)
                            ->where('actas.estado', Acta::ESTADO_CERRADA)
                            ->orderBy('actas.created_at', 'DESC')
                            ->get()->first();
        return $exp;
    }
    
    public function cantidadDeRechazosCiudadano(){
        $cantidad = Expediente::select(['acta_expediente.*'])
                            ->leftJoin('acta_expediente', 'expedientes.id', '=', 'acta_expediente.expediente_id')
                            ->leftJoin('actas', 'acta_expediente.acta_id', '=', 'actas.id')
                            ->where('expedientes.id', $this->id)
                            ->where('actas.estado', Acta::ESTADO_CERRADA)
                            ->where('acta_expediente.respuesta_ciudadano', '=', 'rechazado')
                            ->get()->count();
        return $cantidad;
    }
    
    public function estadoActual(){
        
        // Busco el estado más actualizado del expediente
        $exp = $this->getUltimoTratamientoReunion();
        
        if(is_null($exp)){
            $estado = Expediente::ESTADO_PENDIENTE;
        }else{               
            $estado = $exp->estado;
            if(is_null($estado)){
                $estado = Expediente::ESTADO_PENDIENTE;
            }

            if($exp->respuesta_ciudadano == 'rechazado'){
                $estado = Expediente::ESTADO_RECHAZADO_CIUDADANO;
            }

        }
                                                    
        return $estado;
        
    }
    
    /* 
     * Llego un aviso de rechazo del ciudadano, buscamos la ultima vez donde se
     * trato el expediente y reflejamos la situacion
     */
    public function ciudadanoRechaza($motivo){
        
        $ultima_acta_id = $this->getUltimaReunion();
        
        $monto_rechazado = $this->monto_otorgado;
        $expediente_year = date('Y',strtotime($this->created_at));
        
        if($ultima_acta_id > 0){
            DB::statement("UPDATE acta_expediente SET respuesta_ciudadano = 'rechazado', motivo_respuesta_ciudadano = '".$motivo."', monto_rechazado = '".$monto_rechazado."' where acta_expediente.acta_id = '".$ultima_acta_id."' and acta_expediente.expediente_id = '".$this->id."'");
            
            DB::statement("UPDATE presupuestos SET monto = monto + ".$monto_rechazado." where year = '".$expediente_year."' and linea_id = ".$this->linea_id."");
        }else{
            throw new Exception("El expediente nunca fue tratado");
        }

    }

    public function getUltimaReunion(){
        return ActaExpediente::ultimaActa($this->id);
    }

    public function getMotivoDeRechazo(){
        $exp = $this->getUltimoTratamientoReunion();

        if(is_null($exp)){
            return '';
        }else{
            return $exp->motivo_respuesta_ciudadano;
        }
    }
    
    public function monto_otorgado_letras(){       
    	$formatter = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
		return $formatter->format($this->monto_otorgado);
    }
    
    
    public function monto_otorgado_rectificado(){
        
        $expediente_rechazado = Expediente::select(['acta_expediente.monto_rechazado'])
                            ->leftJoin('acta_expediente', 'expedientes.id', '=', 'acta_expediente.expediente_id')
                            ->leftJoin('actas', 'acta_expediente.acta_id', '=', 'actas.id')
                            ->where('expedientes.id', $this->id)
                            ->where('actas.estado', Acta::ESTADO_CERRADA)
                            ->where('acta_expediente.respuesta_ciudadano', '=', 'rechazado')
                            ->orderBy('actas.created_at', 'DESC')
                            ->get()->first();
                            
        return $expediente_rechazado->monto_rechazado;
    
    }
    
    public function nro_acta_rectificada(){
        
        $expediente_rechazado = Expediente::select(['actas.nro_acta'])
                            ->leftJoin('acta_expediente', 'expedientes.id', '=', 'acta_expediente.expediente_id')
                            ->leftJoin('actas', 'acta_expediente.acta_id', '=', 'actas.id')
                            ->where('expedientes.id', $this->id)
                            ->where('actas.estado', Acta::ESTADO_CERRADA)
                            ->where('acta_expediente.respuesta_ciudadano', '=', 'rechazado')
                            ->orderBy('actas.created_at', 'DESC')
                            ->get()->first();
                            
        return $expediente_rechazado->nro_acta;
    
    }
    
    public function monto_otorgado_rectificado_letras(){
        $formatter = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
		return $formatter->format($this->monto_otorgado_rectificado());
    }
    

}


