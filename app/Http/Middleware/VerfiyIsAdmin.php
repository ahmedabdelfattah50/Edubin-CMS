<?php

namespace App\Http\Middleware;

use Closure;

class VerfiyIsAdmin
{
    public function handle($request, Closure $next)
    {
        // ######## if the login user is not an admin
        if(! auth()->user()->isAdmin()){
            return redirect(route('dashboard.index'));
        }
        return $next($request);
    }
}
