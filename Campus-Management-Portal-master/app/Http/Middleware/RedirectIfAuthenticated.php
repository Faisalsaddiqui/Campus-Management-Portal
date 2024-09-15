<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($this->getDashboardRoute());
            }
        }

        return $next($request);
    }

    private function getDashboardRoute()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return '/admin/dashboard';
        } else if ($user->hasRole('student')) {
            return '/student/dashboard';
        } else if ($user->hasRole('teacher')) {
            return '/teacher/dashboard';
        } else if ($user->hasRole('applicant')) {
            return '/applicant/dashboard';
        } else {
            return RouteServiceProvider::HOME;
        }
    }
}
