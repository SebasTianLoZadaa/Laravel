<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/**
 * Elimina los espacios innecesarios de texto
 */

class TrimStrings extends Middleware
{
    /**
     * nombre los campos que no se deben limpiar de espacios
     *
     * @var array<int, string>
     */

    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];

}
