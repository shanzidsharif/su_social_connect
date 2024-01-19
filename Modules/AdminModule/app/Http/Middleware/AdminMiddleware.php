<?php

namespace Modules\AdminModule\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && in_array(auth()->user()->user_type, ADMIN)) {
            return $next($request);
        }
       return redirect('/admin/auth/login');
    }
}
