<?php namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;
class CORS {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if($request->getMethod() == "OPTIONS") {
			// die("-------------------sss");
			// The client-side application can set only headers allowed in Access-Control-Allow-Headers
			return Response::make('OK', 200, [
				'Access-Control-Allow-Origin' => '*',
				'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, access_token,Authorization',
				'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE'
				]);
		}
        // return $next($request);
        $content = $next($request);
    
        $content->headers->set('Access-Control-Allow-Origin', '*');
        $content->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $content->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin, access_token,__setXHR_');
        return $content;
	}

}