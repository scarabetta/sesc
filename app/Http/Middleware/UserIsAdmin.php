<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class UserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->rol->nombre != 'administrador'){
            //Auth::logout();
            return redirect('/')->withErrors('El usuario no tiene permisos suficientes.');
        }
        
        return $next($request);
    }
}

?>
