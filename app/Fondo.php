<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Fondo extends Model {

    protected static $actions = [
        'PRD' => ['monto','suplente'],
        'PRT' => ['monto'],
        'BAM' => ['monto'],
        'MZ' => ['monto','suplente'],
    ];

    protected static $actas = [
        'PRD' => 'actas.acta_pd',
        'PRT' => 'actas.acta_pt',
        'BAM' => 'actas.acta_bam',
        'MZ' => 'actas.acta_mz',
    ];

    protected static $rechazos = [
        'PRD' => 'actas.rechazado_pd',
        'PRT' => 'actas.rechazado_pt',
        'BAM' => 'actas.rechazado_bam',
        'MZ' => 'actas.rechazado_mz',
    ];

    protected static $aceptaciones = [
        'PRD' => 'actas.aceptado_pd',
        'PRT' => 'actas.aceptado_pt',
        'BAM' => 'actas.aceptado_bam',
        'MZ' => 'actas.aceptado_mz',
    ];

    protected static $codigos = [
        'PRD' => 'PD',
        'PRT' => 'PT',
        'BAM' => 'BAM',
        'MZ' => 'MZ',
    ];

	public function lineas(){
        return $this->hasMany('App\Linea');
    }

    public function users(){
        return $this->hasMany('App\User');
    }

    public function tipoVotacion(){
        return $this->hasMany('App\TipoVotacion');
    }

    public function acceptsBudget(){
        return in_array('monto', self::$actions[$this->codigo]);
    }

    public function acceptsSubstitute(){
        return in_array('suplente', self::$actions[$this->codigo]);
    }
    
    public function getJuecesYCoordinadores(){
        return $this->users()
        ->select('users.id as juez_id', 'users.*')
        ->join('roles', function($join){
            $join->on('users.rol_id', '=', 'roles.id')
                ->where('nombre', '<>', 'administrador');
        })
        ->get();
    }

    public function getJueces(){
        return $this->users()
        ->select('users.id as juez_id', 'users.*')
        ->join('roles', function($join){
            $join->on('users.rol_id', '=', 'roles.id')
                ->where('nombre', '=', 'juez');
        })
        ->get();
    }

    public function getViewActa(){
        return self::$actas[$this->codigo];
    }

    public function getViewRechazado(){
        return self::$rechazos[$this->codigo];
    }

    public function getViewAceptado(){
        return self::$aceptaciones[$this->codigo];
    }

    public function getCodigo(){
        return self::$codigos[$this->codigo];   
    }
}
