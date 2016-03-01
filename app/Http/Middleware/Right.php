<?php

namespace App\Http\Middleware;

use Closure;

class Right
{
    public function handle($request, Closure $next)
    {
        if($request->segment(2) != config('oblagio.firstMenu'))
        {
            if(og()->cekRight() == 'false')
            {
                return redirect()->back()->withWarning('You cannot authorize that page');
            }
        }

        return $next($request);
        
    }
}
