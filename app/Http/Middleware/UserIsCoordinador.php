<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class UserIsCoordinador
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
        if (Auth::user()->rol->nombre != 'coordinador'){
            Auth::logout();
            return redirect('/')->withErrors('El usuario no tiene permisos suficientes.');
        }
        
        return $next($request);
    }
}

?>
