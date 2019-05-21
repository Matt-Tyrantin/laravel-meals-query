<?php

namespace App\Http\Middleware;

use Closure;

class VerifyTimestampConstraint
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
        if($request->exists('diff_time') && $request->get('diff_time') < 1){
            return redirect($request->fullUrl() .'&diff_time=1');
        }

        return $next($request);
    }
}
