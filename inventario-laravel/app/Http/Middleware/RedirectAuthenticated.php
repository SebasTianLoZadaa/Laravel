<?php

use Illuminate\Auth\Middleware\RedirectIfAuthenticated as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Es la que redirige al usuario a dashboards si ya esta autenticado
 */

class RedirectAuthenticated extends Middleware
{
    public function handle(Request $request, \Closure $next, string ...$guards):\Symfony\Component\HttpFoundation\Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
