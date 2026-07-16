<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// restringe el acceso a usuario que no tenga rol

class CoordinadorMiddleware
{
    // Maneja la peticion entrante y valida si el usuario tiene permisos de admin
    // @param  \closure(Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'coordinador' || Auth::user()->role === 'admin') {
            return $next($request);
        }

        abort(403, 'No tienes permisos de coordinador.');
    }
}
