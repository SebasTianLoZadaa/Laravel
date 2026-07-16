<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;

/**
 * Valida el token CSRF para proteger contra ataques de falsificación de solicitud
 */

class VerifyCsrfToken extends Middleware
{
    /**
     * nombre los campos que no se deben limpiar de espacios
     *
     * @var array<int, string>
     */

    protected $except = [
        // 'fbcclid,
        // 'utm_campaign',
        // 'utm_content',
        // 'utm_medium',
        // 'utm_source',
        // 'utm_term',
        ];

}
