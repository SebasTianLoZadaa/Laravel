<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ValidateSignature as Middleware;
use Illuminate\Http\Request;

/**
 * Valida la firma de las solicitudes de url para proteger los enlaces sensibles
 */

class ValidateSignature extends Middleware
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
