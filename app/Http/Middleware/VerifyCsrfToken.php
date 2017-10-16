<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {
    
    protected $except = [
        'api/*',
        'esb/*',
    ];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{   
        if (
            parent::isReading($request) ||
            parent::shouldPassThrough($request) ||
            parent::tokensMatch($request)
        ) {
            return parent::addCookieToResponse($request, $next($request));
        }

        return redirect('/')->with('alert-danger','La sesión expiró, por favor ingrese nuevamente.');
	}

}
