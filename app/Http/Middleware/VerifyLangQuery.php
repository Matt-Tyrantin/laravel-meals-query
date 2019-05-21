<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

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
            $addQuestionMark = !strstr( $request->fullUrl(), '?');
            return redirect($request->fullUrl() .($addQuestionMark? '?': '&' ) .'lang=en');
        }

        if(!in_array($request->get('lang'), Config::get('seeder.languages'))){
            return redirect(
                str_replace('lang='.$request->get('lang'), 'lang=en', $request->fullUrl())
            );
        }

        return $next($request);
    }
}
