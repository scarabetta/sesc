<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use PDF;

use Auth;
use App\Fondo;

class Acta extends Model {

    const ESTADO_ABIERTA = 1;
    const ESTADO_CERRADA = 2;

    protected static $states = [
        '1' => 'Abierta',
        '2' => 'Cerrada'
    ];
    
    protected $fillable = [
            'observaciones'
        ];

	public function users(){
        return $this->belongsToMany('App\User', 'acta_user');
    }
    
    public function expedientes(){
        return $this->belongsToMany('App\Expediente', 'acta_expediente')
            ->withPivot('estado')
            ->withPivot('plus')
            ->withPivot('nroregistro')
            ->withPivot('observaciones');
    }

    // Obtiene las actas abiertas de un fondo
    public static function getOpenByFondo($fondo_id){
        $acta = Acta::select('actas.*')
            //->where('actas.estado', self::ESTADO_ABIERTA)
            ->whereNull('actas.nro_gedo')
            ->join('acta_expediente', 'acta_id', '=', 'actas.id')
            ->join('expedientes', 'acta_expediente.expediente_id', '=', 'expedientes.id')
            ->join('lineas', function($join) use($fondo_id){
                $join->on('lineas.id', '=', 'expedientes.linea_id');
                $join->on('lineas.fondo_id', '=', DB::raw($fondo_id));
            })
            ->orderBy('actas.created_at', 'desc')
            ->first();

        return $acta;
    }

    public function prnt($fondo_id){
        
        $fondo = Fondo::find($fondo_id);
        $view = $fondo->getViewActa();

        $meses = array( 1 =>'Enero',2=>'Febrero', 3=>'Marzo', 
                        4 =>'Abril', 5=>'Mayo', 6=>'Junio', 
                        7 =>'Julio', 8=>'Agosto', 9=>'Septiembre',
                        10=>'Octubre', 11=>'Noviembre', 12=>'Diciembre');
        
        $fecha_actual = array(  'dia'=>date('d',strtotime($this->created_at)), 
                                'mes'=>$meses[intval(date('m'))],
                                'year'=>date('Y',strtotime($this->created_at)),
                                'hora'=>date('H:i',strtotime($this->created_at))
                            );
                            
        $jueces_fondo = $fondo->getJuecesYCoordinadores();
        $diff = $jueces_fondo->diff($this->users()->get());      
        $jueces_ausentes = $diff->all();
        $coordinador = Auth::user();
                            
        $filas_jueces = $this->users->toArray();
        
        /* Cambiar si pdf no anda */
        /*
        return view($view, [   'acta'=>$this, 
                                                'fondo' => $fondo,
                                                'coordinador' => $coordinador,
                                                'jueces_ausentes'=>$jueces_ausentes,
                                                'filas_jueces'=>$filas_jueces,
                                                'fecha_actual'=>$fecha_actual,
                                                'jueces_total'=>count($this->users),
                                                'jueces_ausentes_total'=>count($jueces_ausentes),
                                                'expedientes_estado_aceptado'=>Expediente::ESTADO_ACEPTADO,
                                                'expedientes_estado_rechazado'=>Expediente::ESTADO_RECHAZADO,
                                            ]);
        */
        
        $pdf = PDF::loadView($view,    [   'acta'=>$this, 
                                                'fondo' => $fondo,
                                                'coordinador' => $coordinador,
                                                'jueces_ausentes'=>$jueces_ausentes,
                                                'filas_jueces'=>$filas_jueces,
                                                'fecha_actual'=>$fecha_actual,
                                                'jueces_total'=>count($this->users),
                                                'jueces_ausentes_total'=>count($jueces_ausentes),
                                                'expedientes_estado_aceptado'=>Expediente::ESTADO_ACEPTADO,
                                                'expedientes_estado_rechazado'=>Expediente::ESTADO_RECHAZADO,
                                            ]);
        return $pdf->download('acta_'. $this->nro_acta .'.pdf');
        

    }

    public function prnt_expediente($expediente_id){
        
        $expediente = Expediente::find($expediente_id);
        $fondo = $expediente->linea->fondo;
        $coordinador = Auth::user();

        $acta_expediente = ActaExpediente::
            where('acta_id', $this->id)
            ->where('expediente_id', $expediente->id)
            ->first();

        if($acta_expediente->estado == Expediente::ESTADO_RECHAZADO){
            $view = $fondo->getViewRechazado();
        }else{
            $view = $fondo->getViewAceptado();
        }

        $meses = array( 1 =>'Enero',2=>'Febrero', 3=>'Marzo', 
                        4 =>'Abril', 5=>'Mayo', 6=>'Junio', 
                        7 =>'Julio', 8=>'Agosto', 9=>'Septiembre',
                        10=>'Octubre', 11=>'Noviembre', 12=>'Diciembre');
        
        $fecha_actual = array(  'dia'=>date('d'), 
                                'mes'=>$meses[intval(date('m'))],
                                'year'=>date('Y'),
                                'hora'=>date('H:i')
                            );
        $pdf = PDF::loadView($view, [   'fondo' => $fondo,
                                        'coordinador' => $coordinador,
                                        'reunion' => $this,
                                        'acta_expediente' => $acta_expediente,
                                        'expediente' => $expediente,
                                        'fecha_actual'=>$fecha_actual,
                                        ]);
        return $pdf->download('notificacion_'. $this->nro_acta .'_'. $expediente->id .'.pdf');

    }

    public function generateNumber($fondo_id){

        $fondo = Fondo::find($fondo_id);

        $number = $fondo->getCodigo(). '-' .sprintf("%06s", $this->id). '-' .date('Y');
        $this->nro_acta = $number;
        $this->save();
    }
    
    // Metodos para generacion de actas
    
    // Expedientes no rectificados

    public function countExpedientesLinea($linea_id){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('expedientes.linea_id', '=', DB::Raw($linea_id))
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->groupBy('linea_id', 'acta_expediente.plus')
            ->count();
    }

    public function countLineaPlus($linea_id, $plus){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('expedientes.linea_id', '=', DB::Raw($linea_id))
            ->where('acta_expediente.plus', '=', DB::Raw($plus))
            ->where('acta_expediente.estado', '=', Expediente::ESTADO_ACEPTADO)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->groupBy('linea_id', 'acta_expediente.plus')
            ->count();
    }

    public function countAceptadosLinea($linea_id){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('expedientes.linea_id', '=', DB::Raw($linea_id))
            ->where('acta_expediente.estado', '=', Expediente::ESTADO_ACEPTADO)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->groupBy('linea_id', 'acta_expediente.plus')
            ->count();
    }

    public function countRechazadosLinea($linea_id){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('expedientes.linea_id', '=', DB::Raw($linea_id))
            ->where('acta_expediente.estado', '=', Expediente::ESTADO_RECHAZADO)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->groupBy('linea_id', 'acta_expediente.plus')
            ->count();
    }

    public function countRechazados(){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('acta_expediente.estado', '=', Expediente::ESTADO_RECHAZADO)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->count();
    }
    
    
    
    // Expedientes rectificados
    
    public function countRectificados(){
        return Expediente::select('*')
            ->join('acta_expediente', 'acta_expediente.expediente_id', '=', 'expedientes.id')
            ->join('actas', 'acta_expediente.expediente_id', '=', 'expedientes.id')
            ->where('actas.id', '=', $this->id)
            ->where('acta_expediente.estado', '<>', Expediente::ESTADO_PENDIENTE)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })->count();
    }
    
    
    public function countExpedientesLineaRectificados($linea_id){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('expedientes.linea_id', '=', DB::Raw($linea_id))
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->groupBy('linea_id', 'acta_expediente.plus')
            ->count();
    }

    public function countLineaPlusRectificados($linea_id, $plus){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('expedientes.linea_id', '=', DB::Raw($linea_id))
            ->where('acta_expediente.plus', '=', DB::Raw($plus))
            ->where('acta_expediente.estado', '=', Expediente::ESTADO_ACEPTADO)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->groupBy('linea_id', 'acta_expediente.plus')
            ->count();
    }

    public function countAceptadosLineaRectificados($linea_id){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('expedientes.linea_id', '=', DB::Raw($linea_id))
            ->where('acta_expediente.estado', '=', Expediente::ESTADO_ACEPTADO)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->groupBy('linea_id', 'acta_expediente.plus')
            ->count();
    }

    public function countRechazadosLineaRectificados($linea_id){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('expedientes.linea_id', '=', DB::Raw($linea_id))
            ->where('acta_expediente.estado', '=', Expediente::ESTADO_RECHAZADO)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->groupBy('linea_id', 'acta_expediente.plus')
            ->count();
    }
    
    public function countAceptadosRectificados(){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('acta_expediente.estado', '=', Expediente::ESTADO_ACEPTADO)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->count();
    }

    public function countRechazadosRectificados(){
        return $this->expedientes()
            ->selectRaw('linea_id, acta_expediente.plus')
            ->where('acta_expediente.estado', '=', Expediente::ESTADO_RECHAZADO)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('acta_expediente as ae')
                      ->whereRaw("ae.expediente_id = acta_expediente.expediente_id and ae.respuesta_ciudadano = 'rechazado' and ae.acta_id <> acta_expediente.acta_id");
            })
            ->count();
    }
    
    
    

}
