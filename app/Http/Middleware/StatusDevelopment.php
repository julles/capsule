<?php

namespace App\Http\Middleware;

use Closure;

class StatusDevelopment
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
        if(og()->statusDevelopment == 'down')
        {
            \Artisan::call('down');
            return redirect()->refresh();
        }

        return $next($request);
        
    }
}
