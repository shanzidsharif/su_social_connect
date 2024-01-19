<?php

namespace Modules\TeacherModule\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->user_type === TEACHER) {
            return $next($request);
        }
        return redirect('/teacher/auth/login');
    }
}
