
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    // ...existing code...

    protected $except = [
        // Add any routes that should be excluded from CSRF verification
    ];

    // ...existing code...
}