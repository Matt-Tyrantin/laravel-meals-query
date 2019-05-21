<?php

namespace App\Http\Middleware;

use Closure;

class ShowPageQuery
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
        if(!$request->exists('page')){
            $addQuestionMark = !strstr( $request->fullUrl(), '?');
            return redirect($request->fullUrl() .($addQuestionMark? '?': '&' ) .'page=1');
        }
        return $next($request);
    }
}
