<?php namespace App\Http\Controllers\Auth;

use App;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function postLogin(Request $request){

        $validations = [
          'email' => 'required|email',
          'password' => 'required'
        ];
        
        if (!App::environment(['testing'])){
            $validations['captcha'] = 'required|valid_captcha';
        }
        
        $this->validate($request, $validations);

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
           return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
           return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
           $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
           ->withInput($request->only($this->loginUsername(), 'remember'))
           ->withErrors([
               $this->loginUsername() => $this->getFailedLoginMessage(),
           ]);

	}

}
