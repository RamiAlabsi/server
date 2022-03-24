<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (count(Auth::user()->stores) == 0)
            return redirect('/vendor/stores')->with(['alert' => [
                'icon' => 'error',
                'title' => __('lang.alert_create_store_first'),
                'text' => __('lang.alert_dont_have_stores')
            ]]);
        return $next($request);
    }
}
