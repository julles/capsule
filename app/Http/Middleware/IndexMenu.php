<?php

namespace App\Http\Middleware;

use Closure;

class IndexMenu
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
        if(empty($request->segment(3)))
        {
            return redirect($request->url().'/index');
        }
        return $next($request);
    }
}
