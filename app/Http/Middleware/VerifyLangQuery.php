<?php

namespace App\Http\Middleware;

use Closure;

class VerifyLangQuery
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
        if(!$request->exists('lang')){
            return redirect($request->fullUrl() .'&lang=en');
        }

        return $next($request);
    }
}
