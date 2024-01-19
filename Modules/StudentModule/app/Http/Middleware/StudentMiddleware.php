<?php

namespace Modules\StudentModule\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->user_type === STUDENT) {
            return $next($request);
        }
       return redirect('/student/auth/login');
    }
}
