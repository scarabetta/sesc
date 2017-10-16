<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Exception;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'surename', 'email', 'password', 'rol_id', 'fondo_id', 'titulo', 'vota', 'comenta', 'usuario_sade'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    protected static $permissions = [
        'administrador' => ['users'],
        'coordinador' => ['editar_presupuesto', 'ver_presupuesto','ver_expedientes', 'sincronizar_expedientes',
                            'generar_acta', 'dashboard', 'monto_final', 'estado','ver_monto_disponible', 'ver_monto_solicitado'
                            ],
        'juez' => ['ver_expedientes','ver_expedientes', 'dashboard']
    ];
    
    public function fillFields($data){
        
        if($data['name']==''){
            throw new Exception("Debe llenar el campo Nombre");
        }
        
        if($data['surename']==''){
            throw new Exception("Debe llenar el campo Apellido");
        }
        
        if($data['email']==''){
            throw new Exception("Debe llenar el campo E-mail");
        }
        
        if($data['password']==''){
            throw new Exception("Debe llenar el campo Password");
        }
        
        $rol = Rol::select('*')->where('id', $data['rol_id'])->first();
        
        if($rol->nombre=='coordinador' && trim($data['usuario_sade'])==''){
            throw new Exception("Debe llenar el campo Usuario de SADE");
        }

        $user = User::select('*')->where('email', $data['email'])->first();
                                    
        if(isset($user->id) and $user->id > 0){
            throw new Exception("Ocurrió un problema al crear el usuario: Compruebe que la cuenta de e-mail no esté siendo utilizada por otro usuario");
        }

        $this->fill($data);

    }

    public function rol(){
        return $this->belongsTo('App\Rol');
    }

    public function fondo(){
        return $this->belongsTo('App\Fondo');
    }
    
    public function actas(){
        return $this->belongsToMany('App\Acta', 'acta_user');
    }
    
    public function canViewMontoDisponible(){
        return in_array('ver_monto_disponible', self::$permissions[$this->rol->nombre]);
    }
    
    public function canViewMontoSolicitado(){
        return in_array('ver_monto_solicitado', self::$permissions[$this->rol->nombre]);
    }


    public function hasDashboard(){
        return in_array('dashboard', self::$permissions[$this->rol->nombre]);
    }

    public function canManageUsers(){
        return in_array('users', self::$permissions[$this->rol->nombre]);
    }

    public function canEditBudget(){
        return in_array('editar_presupuesto', self::$permissions[$this->rol->nombre]);
    }

    public function canViewBudget(){
        return in_array('ver_presupuesto', self::$permissions[$this->rol->nombre]);
    }

    public function canViewProjects(){
        return in_array('ver_expedientes', self::$permissions[$this->rol->nombre]);
    }

    public function canSyncProjects(){
        return in_array('sincronizar_expedientes', self::$permissions[$this->rol->nombre]);
    }

    public function canGenerateMinute(){
        return in_array('generar_acta', self::$permissions[$this->rol->nombre]);
    }

    public function canManageNotifications(){
        return in_array('generar_notificacion', self::$permissions[$this->rol->nombre]);
    }

    public function canViewFinalBudget(){
        return in_array('monto_final', self::$permissions[$this->rol->nombre]);   
    }

    public function canViewStatus(){
        return in_array('estado', self::$permissions[$this->rol->nombre]);   
    }

    public static function getJuecesByFondo($id_fondo){
        return User::where('fondo_id', $id_fondo)->get();
    }
}
