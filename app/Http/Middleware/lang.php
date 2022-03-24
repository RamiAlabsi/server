<?php

namespace App\Http\Middleware;

use Closure;

class lang
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
       // app()->setLocale();
           $lang = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : app()->getLocale();
        //Set laravel localization
        app()->setLocale($lang);

        //Continue request
        return $next($request);
    }
}